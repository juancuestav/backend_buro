import { useNotificaciones } from "@components/toastification/application/notificaciones"
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"
import { ContenedorMixin } from "@shared/contenedorMixin/ContenedorMixin"
import { getEndpoint } from "@/shared/http/utils"
import { endpoints } from "@config/api.config"
import { Ref } from "vue"
import axios from "axios"

// Botones
const renderMostrarChat = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-eye me-2'></i>Consultar</span>`
}

const renderLeido = function (cell, formatterParams) {
    return `<span class="btn btn-danger btn-sm"><i class='bi-hand-thumbs-down-fill me-2'></i>Anular</span>`
}

export class EventosTabla {
    private mixin: ContenedorMixin
    private accion: Ref

    constructor(mixin: ContenedorMixin, accion: Ref) {
        this.mixin = mixin
        this.accion = accion
    }

    private obtenerAccionesTabla() {
        const { notificarCorrecto, notificarError } = useNotificaciones()
        return {
            consultar: (data: any) => {
                window.location.href =
                    getEndpoint(endpoints.mostrar_detalles_pedido) + data.id
            },
            anular: (dataFilaSeleccionada: any) => {
                ConfirmationDialog.mostrar({
                    mensaje:
                        "Esta operación no es reversible.\n¿Desea continuar?",
                    btnConfirmText: "Anular",
                    confirmFunction: async () => {
                        const ruta =
                            getEndpoint(endpoints.mis_pedidos) + "anular"
                        try {
                            const response = await axios.post(ruta, {
                                pedido: dataFilaSeleccionada.id,
                            })
                            notificarCorrecto(response.data.mensaje)
                        } catch (error: any) {
                            notificarError(error.response.data.mensaje)
                        }
                    },
                })
            },
        }
    }

    obtenerBotonesEventos() {
        const accionesTabla = this.obtenerAccionesTabla()

        return [
            {
                formatter: renderMostrarChat,
                hozAlign: "center",
                headerSort: false,
                vertAlign: "middle",
                responsive: 0,
                cellClick: function (e, cell) {
                    accionesTabla.consultar(cell.getRow().getData())
                },
            },
            {
                formatter: renderLeido,
                hozAlign: "center",
                headerSort: false,
                vertAlign: "middle",
                responsive: 0,
                cellClick: function (e, cell) {
                    accionesTabla.anular(cell.getRow().getData())
                },
            },
        ]
    }
}
