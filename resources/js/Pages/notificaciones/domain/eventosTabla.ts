import { useNotificaciones } from "@components/toastification/application/notificaciones"
import ConfirmationDialog from "@components/confirmationDialog/ConfirmationDialog"
import { Notificacion } from "./Notificacion.domain"
import { endpoints } from "@config/api.config"
import { getEndpoint } from "@shared/http/utils"
import store from "@/store"
import axios from "axios"
import { Ref } from "vue"

// Botones
const renderMostrarChat = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-chat-dots me-2'></i>Abrir chat</span>`
}

const renderLeido = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-check me-2'></i>Marcar como leído</span>`
}

export class EventosTabla {
    listado: Ref<[]>

    constructor(listado: Ref<[]>) {
        this.listado = listado
    }

    private obtenerAccionesTabla() {
        return {
            abrirChat: async (datos: any) => {
                const ruta = getEndpoint(endpoints.notificaciones) + datos.id
                const response = await axios.get(ruta)

                store.commit("chat/SET_NOTIFICACION", response.data.modelo)
                store.dispatch("chat/mostrarChat")
            },
            marcarLeido: async (fila: any) => {
                const { notificarCorrecto } = useNotificaciones()

                ConfirmationDialog.mostrar({
                    mensaje:
                        "Esta notificación estará disponible en la pestaña Todos.\n¿Desea continuar?",
                    btnConfirmText: "He leído la notificación",
                    confirmFunction: async () => {
                        const ruta =
                            getEndpoint(endpoints.notificaciones) + fila.id
                        const response = await axios.put(ruta)
                        this.listado.value.splice(
                            this.indiceNotificacion(fila.id),
                            1
                        )

                        notificarCorrecto(response.data.mensaje)
                    },
                })
            },
        }
    }

    private indiceNotificacion(id: string) {
        return this.listado.value.findIndex(
            (notificacion: Notificacion) => notificacion.id === id
        )
    }

    obtenerBotonesEventos(tipoNotificacion: string) {
        const accionesTabla = this.obtenerAccionesTabla()

        if (tipoNotificacion === "nuevos") {
            return [
                {
                    formatter: renderMostrarChat,
                    hozAlign: "center",
                    headerSort: false,
                    vertAlign: "middle",
                    responsive: 0,
                    cellClick: function (e, cell) {
                        accionesTabla.abrirChat(cell.getRow().getData())
                    },
                },
                {
                    formatter: renderLeido,
                    hozAlign: "center",
                    headerSort: false,
                    vertAlign: "middle",
                    responsive: 0,
                    cellClick: function (e, cell) {
                        accionesTabla.marcarLeido(cell.getRow().getData())
                    },
                },
            ]
        } else {
            return [
                {
                    formatter: renderMostrarChat,
                    hozAlign: "center",
                    headerSort: false,
                    vertAlign: "middle",
                    responsive: 0,
                    cellClick: function (e, cell) {
                        accionesTabla.abrirChat(cell.getRow().getData())
                    },
                },
            ]
        }
    }
}
