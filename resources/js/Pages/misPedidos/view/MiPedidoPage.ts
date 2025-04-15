// Dependencias
import { useNotificaciones } from "@components/toastification/application/notificaciones"
import { configuracionColumnas } from "@/Pages/pedidos/domain/configuracionColumnas"
import { defineComponent, getCurrentInstance, ref, watch } from "vue"
import { gestionarNotificacionError } from "@shared/utils"
import { ApiError } from "@shared/http/ApiError"
import axios from "axios"

// Componentes
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"
import SidebarLayout from "@shared/contenedor/view/SidebarLayout.vue"
import Listado from "@components/listado/Listado.vue"

// Logica y controladores
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { MiPedidoController } from "../infraestructure/MiPedidoController"
import { Pedido } from "../domain/Pedido.domain"
import { EventosTabla } from "../domain/EventosTabla"

export default defineComponent({
    components: { SidebarLayout, Listado },
    setup(props) {
        const mixin = new ContenedorMixin(Pedido, new MiPedidoController())
        const { listado, accion } = mixin.useReferencias()
        const { listar } = mixin.useComportamiento()

        const app = getCurrentInstance()
        const $route = app?.appContext.config.globalProperties.$route

        const anularPedido = async (dataFilaSeleccionada: any) => {
            const { notificarCorrecto } = useNotificaciones()
            ConfirmationDialog.mostrar({
                mensaje: "Esta operación no es reversible.\n¿Desea continuar?",
                btnConfirmText: "Anular",
                confirmFunction: async () => {
                    const ruta = $route("mis-pedidos.anular")
                    try {
                        const response = await axios.post(ruta, {
                            pedido: dataFilaSeleccionada.id,
                        })
                        notificarCorrecto(response.data.mensaje)
                    } catch (error: any) {
                        gestionarNotificacionError(new ApiError(error))
                    }
                },
            })
        }

        // Tachar pedidos anuladas
        const indicesFilasAnuladas: any = ref([])

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

        listar()

        const botones = new EventosTabla(mixin, accion).obtenerBotonesEventos()
        const configuracionCols = [...botones, ...configuracionColumnas]

        return {
            listado,
            // consultarPedido,
            anularPedido,
            indicesFilasAnuladas,
            configuracionCols,
        }
    },
})
