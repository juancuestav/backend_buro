import { useNotificaciones } from "./components/toastification/application/notificaciones"
import { isAxiosError } from "./http/utils"
import * as moment from "moment"
import "moment/locale/es"

export function sleep(ms: number): Promise<void> {
    return new Promise((res) => setTimeout(res, ms))
}

export async function notificarMensajesError(
    mensajes: string[]
): Promise<void> {
    const { notificarAdvertencia } = useNotificaciones()

    for (let i = 0; i < mensajes.length; i++) {
        await sleep(0)
        notificarAdvertencia(mensajes[i])
        await sleep(1000)
    }
}

export function gestionarNotificacionError(error: any): void {
    const { notificarAdvertencia } = useNotificaciones()

    if (isAxiosError(error)) {
        const mensajes: string[] = error.erroresValidacion
        if (mensajes.length > 0) {
            notificarMensajesError(mensajes)
        } else {
            if (error.status === 413) {
                notificarAdvertencia(
                    "El tamaño del archivo es demasiado grande."
                )
            } else {
                notificarAdvertencia(error.mensaje)
            }
        }
    } else {
        notificarAdvertencia(error.message)
    }
}

export function textToCapitalize(texto: string) {
    return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase()
}

export function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return "0 Bytes"

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"]

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i]
}

export function findIndexById(listado: any[], id: number) {
    return listado.findIndex((item: any) => item.id === id)
}

export function obtenerMesesAnteriores(
    fecha: moment.Moment,
    cantidadMesesRestar: number
): string[] {
    moment.locale("es")
    const formato = "YYYY-MM-DD"
    var endDate = moment(fecha, formato, true)
    var startDate = endDate.clone().subtract(cantidadMesesRestar, "month")

    let meses: string[] = []

    let month = moment(endDate) //clone the startDate

    while (month > startDate) {
        meses.push(textToCapitalize(month.format("MMMM YYYY")))
        month.subtract(1, "month")
    }

    // console.log(meses)
    return meses
}
