// Dependencias
import { defineComponent, computed, onMounted, ref, watchEffect } from "vue"
import { configuracionColumnas } from "../domain/configuracionColumnas"
import { gestionarNotificacionError } from "@shared/utils"
import { Link } from "@inertiajs/inertia-vue3"
import { Inertia } from "@inertiajs/inertia"
import { useStore } from "vuex"
import axios from "axios"
import {
    metodosPago,
    estadosPreparacion,
    estadosPago,
} from "@config/utils.config"

// Componentes
import { useNotificaciones } from "@components/toastification/application/notificaciones"
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"
import LayoutPedidos from "@shared/contenedor/view/LayoutPedidos.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { PedidoController } from "../infraestructure/PedidoController"
import { Pedido } from "../domain/Pedido"
import { endpoints } from "@config/api.config"
import { getEndpoint } from "@shared/http/utils"

export default defineComponent({
    components: {
        LayoutPedidos,
        Listado,
        Link,
    },
    setup(props) {
        const controller = new PedidoController()
        const mixin = new ContenedorMixin(Pedido, controller)
        const { entidad: pedido, tabIndex, listado } = mixin.useReferencias()

        const store = useStore()

        const mostrarPanelDevolucion = ref(false)
        const existenDevolucionesPendientes = ref(false)
        const permitirPrepararDevolucion = ref(false)

        const refListadoDevolucion = ref()

        const notificaciones = useNotificaciones()

        onMounted(async () => {
            pedido.hydrate(store.state.pedido.pedido)

            tabIndex.value = store.state.pedido.tabIndex

            watchEffect(() => {
                permitirPrepararDevolucion.value =
                    pedido.estado_devolucion !== "DEVUELTO"

                if (!permitirPrepararDevolucion.value) {
                    refListadoDevolucion.value?.ocultarColumna(3)
                } else {
                    refListadoDevolucion.value?.mostrarColumna(3)
                }
            })
        })

        async function registrarPago() {
            if (pedido.metodo_pago === metodosPago.deposito) {
                guardarTabIndexStore()
                const ruta =
                    getEndpoint(endpoints.depositos_transferencias) + "create"
                Inertia.get(ruta, { pedido: pedido.id })
            } else {
                confirmarPagoEfectivo()
            }
        }

        function confirmarPagoEfectivo() {
            ConfirmationDialog.mostrar({
                mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
                btnConfirmText: "Registrar pago",
                confirmFunction: async () => {
                    const ruta = getEndpoint(
                        endpoints.pedidos__registrar_pago_efectivo
                    )
                    try {
                        const response = await axios.post(ruta, {
                            pedido: pedido.id,
                        })
                        notificaciones.notificarCorrecto(response.data.mensaje)

                        const { result } = await controller.consultar(pedido.id)
                        pedido.hydrate(result)
                    } catch (error: any) {
                        gestionarNotificacionError(error)
                    }
                },
            })
        }

        async function anular() {
            ConfirmationDialog.mostrar({
                mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
                btnConfirmText: "Anular",
                confirmFunction: async () => {
                    const ruta = getEndpoint(endpoints.pedidos__anular)
                    try {
                        const response = await axios.post(ruta, {
                            pedido: pedido.id,
                        })
                        notificaciones.notificarCorrecto(response.data.mensaje)

                        const { result } = await controller.consultar(pedido.id)
                        pedido.hydrate(result)
                    } catch (error: any) {
                        gestionarNotificacionError(error)
                    }
                },
            })
        }

        const eliminar = async () => {
            ConfirmationDialog.mostrar({
                mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
                btnConfirmText: "Eliminar",
                confirmFunction: async () => {
                    const ruta = getEndpoint(endpoints.pedidos) + pedido.id

                    try {
                        const response = await axios.delete(ruta)
                        notificaciones.notificarCorrecto(response.data.mensaje)
                        tabIndex.value = 1
                    } catch (error: any) {
                        gestionarNotificacionError(error)
                    }
                },
            })
        }

        const mostrarFormulario = computed(() => pedido.id !== null)

        const guardarTabIndexStore = () => {
            store.commit("pedido/SET_TABINDEX", 0)
        }

        const verListado = () => {
            tabIndex.value = 1
        }

        const consultarPago = () => {
            guardarTabIndexStore()
            const ruta =
                getEndpoint(endpoints.depositos_transferencias) +
                pedido.deposito_transferencia +
                "/edit"
            Inertia.get(ruta)
        }

        return {
            refListadoDevolucion,
            mixin,
            pedido,
            registrarPago,
            anular,
            eliminar,
            mostrarFormulario,
            guardarTabIndexStore,
            verListado,
            listado,
            mostrarPanelDevolucion,
            existenDevolucionesPendientes,
            consultarPago,
            permitirPrepararDevolucion,
            metodosPago,
            estadosPreparacion,
            estadosPago,
            configuracionColumnas,
        }
    },
})
