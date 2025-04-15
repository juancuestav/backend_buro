<template>
    <div class="row">
        <div class="col-12 mb-2">
            <div
                class="d-flex justify-content-between flex-wrap d-flex align-items-start"
            >
                <!-- Botones exportar -->
                <div v-if="permitirExportar" class="btn-group mb-2">
                    <button class="btn btn-light" @click="exportar.excel()">
                        <i class="bi-file-spreadsheet me-2"></i>Excel
                    </button>
                    <button class="btn btn-light" @click="exportar.csv()">
                        <i class="bi-filetype-csv me-2"></i>CSV
                    </button>
                    <button class="btn btn-light" @click="exportar.json()">
                        <i class="bi-filetype-json me-2"></i>JSON
                    </button>
                    <button class="btn btn-light" @click="exportar.pdf()">
                        <i class="bi-file-earmark-pdf me-2"></i>PDF
                    </button>
                </div>

                <button
                    v-if="!isMobileVersion && permitirOcultarColumnas"
                    class="btn btn-light"
                    @click="toggleSelectorColumnas()"
                >
                    <i class="bi-layout-sidebar-inset-reverse me-2"></i>Columnas
                    visibles
                </button>
            </div>
        </div>

        <!-- Columnas visibles -->
        <div v-show="mostrarSelectorColumnas" class="col-12 mb-2">
            <div class="border border-1 rounded-3 p-2">
                <label class="form-label mb-3">Columnas disponibles</label>
                <div id="selectorColumnas"></div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="col-12">
            <div ref="refTabulator" class="mt-0"></div>
        </div>
    </div>
</template>

<script lang="ts">
import { tipoSeleccion } from "@config/utils.config"
import { computed, ref, onMounted, defineComponent, watch } from "vue"
import { TabulatorFull as Tabulator } from "tabulator-tables"
import { useStore } from "vuex"
import { columnaMover } from "./columnaMover"

export default defineComponent({
    props: {
        configuracionColumnas: {
            required: true,
            type: Array,
        },
        elementos: Array,
        contextMenu: Array,
        tipoSeleccion: {
            default: tipoSeleccion.NINGUNA,
        },
        permitirExportar: {
            type: Boolean,
            default: true,
        },
        permitirOcultarColumnas: {
            type: Boolean,
            default: true,
        },
        altoFijo: {
            type: Boolean,
            default: true,
        },
    },

    emits: ["fila-seleccionada"],
    setup(props, { emit }) {
        const listado = computed(() => props.elementos)
        const tabla = ref()
        const refTabulator = ref()
        const mostrarSelectorColumnas = ref(false)
        let selectorColumnasGenerado = false

        const store = useStore()
        const isMobileVersion = computed(
            () => store.state.sidebar.isMobileVersion
        )

        // 1. Inicializar tabla
        async function inicializarTabla() {
            return await new Tabulator(refTabulator.value, {
                height: props.altoFijo ? "calc(100vh - 400px)" : null,
                // movableRows: true,
                // layout: "fitDataFill",
                // layout: "fitData",
                layout: "fitDataStretch",
                // layout: "fitDataTable",
                // layoutColumnsOnNewData: true,
                placeholder: "Sin datos",
                // rowHeight:80,
                // responsiveLayout: "collapse",
                selectable: props.tipoSeleccion,
                // resizableColumnFit: true,
                rowContextMenu: props.contextMenu,
                columns: props.configuracionColumnas,
            })
        }

        // Exportar data
        const exportar = {
            pdf: function () {
                tabla.value.download("pdf", "data.pdf", {
                    orientation: "portrait",
                    title: "Buró de crédito Ecuador",
                })
            },
            excel: function () {
                tabla.value.download("xlsx", "data.xlsx", {
                    sheetName: "My Data",
                })
            },
            csv: function () {
                tabla.value.download("csv", "data.csv")
            },
            json: function () {
                tabla.value.download("json", "data.json")
            },
        }

        function columnasVisibles() {
            const columns = tabla.value.getColumns()
            const fragment = new DocumentFragment()

            for (let column of columns) {
                if (!column.getDefinition().title) continue

                const icon = document.createElement("i")
                icon.classList.add("bi-check-circle-fill", "me-2")
                icon.classList.add(
                    column.isVisible() ? "text-success" : "text-secondary"
                )

                const label = document.createElement("span")
                const title = document.createElement("span")

                label.classList.add(
                    "d-inline-block",
                    "me-4",
                    "mb-2",
                    "cursor-pointer"
                )
                title.textContent = column.getDefinition().title

                label.appendChild(icon)
                label.appendChild(title)

                label.addEventListener("click", function (e) {
                    e.stopPropagation()

                    column.toggle()

                    if (column.isVisible()) {
                        icon.classList.add("text-success")
                        icon.classList.remove("text-secondary")
                    } else {
                        icon.classList.add("text-secondary")
                        icon.classList.remove("text-success")
                    }
                })
                fragment.appendChild(label)
            }

            const selector = document.getElementById("selectorColumnas")
            if (selector) {
                selector.appendChild(fragment)
            }
        }

        function seleccionar() {
            const selectedData = tabla.value.getSelectedData()
            emit("fila-seleccionada", selectedData[0])
        }

        function toggleSelectorColumnas() {
            if (!selectorColumnasGenerado) {
                columnasVisibles()
                selectorColumnasGenerado = true
            }
            mostrarSelectorColumnas.value = !mostrarSelectorColumnas.value
        }

        onMounted(async () => {
            tabla.value = await inicializarTabla()

            tabla.value.on("tableBuilt", function () {
                watch(listado, () => {
                    console.log("nueva data")
                    tabla.value.setData(listado.value)
                })
            })
        })

        function actualizar() {
            tabla.value.redraw()
        }

        return {
            refTabulator,
            exportar,
            mostrarSelectorColumnas,
            seleccionar,
            toggleSelectorColumnas,
            isMobileVersion,
            actualizar,
        }
    },
})
</script>
