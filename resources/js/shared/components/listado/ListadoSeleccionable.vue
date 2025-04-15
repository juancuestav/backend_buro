<template>
    <div ref="refModal" class="modal fade">
        <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleccione</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                    ></button>
                </div>

                <div class="modal-body">
                    <listado
                        ref="refListado"
                        :configuracion-columnas="configuracionColumnas"
                        :elementos="elementos"
                        :permitir-ocultar-columnas="false"
                        :permitir-exportar="false"
                        :tipoSeleccion="tipoSeleccion.UNA_FILA"
                        @fila-seleccionada="emitEventSeleccionar"
                    ></listado>
                </div>

                <div class="modal-footer">
                    <div
                        class="col d-grid gap-2 d-md-flex justify-content-md-end"
                    >
                        <button class="btn btn-primary" @click="seleccionar()">
                            Seleccionar
                        </button>
                        <button
                            class="btn btn-danger text-white"
                            @click="ocultar()"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
// Dependencias
import { defineComponent, ref } from "vue"
import { tipoSeleccion } from "@config/utils.config"

// Componentes
import Modal from "bootstrap/js/src/modal.js"
import Listado from "@components/listado/Listado.vue"

export default defineComponent({
    props: {
        configuracionColumnas: {
            required: true,
            type: Array,
        },
        elementos: Array,
    },
    components: { Listado },
    emits: ["seleccionar"],
    setup(props, { emit }) {
        const refModal = ref()
        const refListado = ref()
        let modal: any

        const mostrar = () => {
            modal = new Modal(refModal.value)
            modal.show()
        }

        const ocultar = () => modal.hide()

        const seleccionar = (result?: any) => {
            if (result) {
                emit("seleccionar", result.id)
                return
            }

            refListado.value.seleccionar()
        }

        const emitEventSeleccionar = (filaSeleccionada: any) => {
            if (filaSeleccionada) {
                emit("seleccionar", filaSeleccionada.id)
                ocultar()
            }
        }

        return {
            refModal,
            refListado,
            mostrar,
            ocultar,
            seleccionar,
            tipoSeleccion,
            emitEventSeleccionar,
        }
    },
})
</script>
