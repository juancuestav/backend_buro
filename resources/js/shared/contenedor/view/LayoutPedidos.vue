<template>
    <sidebar-layout>
        <h3 class="fs-5 mb-4 fw-bold">
            <i :class="`${iconoPagina} me-2`"></i>Panel de {{ tituloTabla }}
        </h3>
        <p class="text-color">{{ descripcionPagina }}</p>

        <!-- Tabs pestañas -->
        <div class="card p-1">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li
                    v-if="mostrarTabFormulario"
                    class="nav-item"
                    role="presentation"
                >
                    <button
                        class="nav-link"
                        :class="{ active: tabIndex === 0 }"
                        data-bs-toggle="pill"
                        data-bs-target="#firstTab"
                        type="button"
                        role="tab"
                        @click="tabIndex = 0"
                    >
                        <i class="bi-pencil-square me-2"></i>Formulario
                    </button>
                </li>
                <!-- v-if="mostrarTabListado" -->
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        :class="{ active: tabIndex === 1 }"
                        data-bs-toggle="pill"
                        data-bs-target="#secondTab"
                        type="button"
                        role="tab"
                        @click="tabIndex = 1"
                    >
                        <i class="bi-list me-2"></i>Listado
                    </button>
                </li>
            </ul>
        </div>

        <!-- Contenido de los tabs -->
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab 1 -->
            <div
                class="tab-pane fade show"
                :class="{ active: tabIndex === 0 }"
                id="firstTab"
                role="tabpanel"
            >
                <div class="card">
                    <div class="card-body p-4">
                        <slot name="formulario" />
                    </div>
                </div>
            </div>

            <!-- Tab 2 -->
            <div
                class="tab-pane fade show"
                :class="{ active: tabIndex === 1 }"
                id="secondTab"
                role="tabpanel"
            >
                <div class="card">
                    <botones-seleccionables
                        v-model="filtrosPedidos"
                    ></botones-seleccionables>
                    <div class="card-body p-4 border-top border-1">
                        <listado
                            :configuracion-columnas="
                                configuracionColumnasWithEvents
                            "
                            :elementos="listado"
                        ></listado>
                    </div>
                </div>
            </div>
        </div>
    </sidebar-layout>
</template>

<script lang="ts">
// Dependencias
import { computed, defineComponent, reactive, ref, watch } from "vue"
import { acciones } from "@config/utils.config"
import { ContextMenuConsultar } from "../domain/contextMenuConsultar.domain"

// Componentes
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import BotonesSeleccionables from "@components/BotonesSeleccionables.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { Pedido } from "@/Pages/pedidos/domain/Pedido"
import { EventosTablaConsultar } from "../domain/EventosTablaConsultar"

export default defineComponent({
    props: {
        configuracionColumnas: {
            required: true,
            type: Array,
        },
        mixin: {
            type: Object as () => ContenedorMixin,
            required: true,
        },
        mostrarButtonSubmits: {
            type: Boolean,
            required: false,
            default: true,
        },
        mostrarTabFormulario: {
            type: Boolean,
            required: false,
            default: true,
        },
        descripcionPagina: {
            type: String,
            required: true,
        },
        iconoPagina: {
            type: String,
            required: true,
        },
    },
    components: {
        SidebarLayout,
        Listado,
        BotonesSeleccionables,
    },
    setup(props) {
        const mixin = props.mixin

        const { entidad, tabIndex, accion, listado } = mixin.useReferencias()
        const { guardar, consultar, editar, eliminar, reestablecer, listar } =
            mixin.useComportamiento()

        const accionesTabla = {
            eliminar: (datos: any) => {
                accion.value = acciones.eliminar
                consultar(datos)
            },
            consultar: (datos: any) => {
                accion.value = acciones.consultar
                consultar(datos)
            },
            editar: (datos: any) => {
                accion.value = acciones.modificar
                consultar(datos)
            },
        }

        // Botones seleccionables
        const opcionesPedidos = reactive({
            todos: true,
            sin_pagar: false,
            abiertos: false,
            cerrados: false,
        })

        const filtrosPedidos = computed({
            get: () => [
                {
                    value: "todos",
                    descripcion: "Todos",
                    estado: opcionesPedidos.todos,
                },
                {
                    value: "sin_pagar",
                    descripcion: "Sin pagar",
                    estado: opcionesPedidos.sin_pagar,
                },
                {
                    value: "abiertos",
                    descripcion: "Abiertos",
                    estado: opcionesPedidos.abiertos,
                },
                {
                    value: "cerrados",
                    descripcion: "Cerrados",
                    estado: opcionesPedidos.cerrados,
                },
            ],
            set: (opcion: any) => {
                cambiarTipo(opcion.value)
                listar({ tipo: opcion.value })
            },
        })

        const tipos = ["todos", "sin_pagar", "abiertos", "cerrados"]

        const cambiarTipo = (value: any) => {
            opcionesPedidos[value] = true
            tipos.forEach((tipo) => {
                if (tipo !== value) {
                    opcionesPedidos[tipo] = false
                }
            })
        }

        listar({ tipo: "todos" })

        const indicesFilasAnuladas: any = ref([])

        watch(tabIndex, () => {
            if (tabIndex.value === 1) {
                cambiarTipo("todos")
                listar({ tipo: "todos" })
            }
        })

        // Tachar pedidos anuladas
        watch(listado, () => {
            const pedidosAnulados = listado.value.filter(
                (pedido: Pedido) => pedido.estado_pago === "ANULADO"
            )

            const idFilasAnuladas = pedidosAnulados.map(
                (pedido: Pedido) => pedido.id
            )

            const indices: number[] = []
            listado.value.forEach((pedido: Pedido, index: number) => {
                if (idFilasAnuladas.includes(pedido.id)) {
                    indices.push(index)
                }
            })
            indicesFilasAnuladas.value = indices
        })

        const contextMenu = new ContextMenuConsultar(
            mixin,
            accion
        ).obtenerContextMenu()

        const eventosTabla = new EventosTablaConsultar(
            mixin,
            accion
        ).obtenerBotonesEventos()
        const configuracionColumnasWithEvents = [
            ...eventosTabla,
            ...props.configuracionColumnas,
        ]

        return {
            entidad,
            tabIndex,
            accion,
            listado,
            // operaciones
            reestablecer,
            consultar,
            editar,
            eliminar,
            guardar,
            accionesTabla,
            filtrosPedidos,
            indicesFilasAnuladas,
            contextMenu,
            configuracionColumnasWithEvents,
            tituloTabla: location.pathname
                .split("/")[2]
                ?.toString()
                .toLowerCase(),
        }
    },
})
</script>
