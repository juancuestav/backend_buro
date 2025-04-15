import { AxiosError } from "axios"

export class ApiError extends Error {
    erroresValidacion: string[]
    mensaje: string
    status?: number

    constructor(error: AxiosError) {
        super()
        this.mensaje = error.response?.data.mensaje
        this.erroresValidacion = this.obtenerMensajesError(error)
        this.status = error.response?.status
    }

    private obtenerMensajesError(error: AxiosError): string[] {
        const mensajes: any[] = []
        if (error.response?.data.errors) {
            const errores = Object.values(error.response.data.errors)
            mensajes.push(...errores.flat())
        }
        return mensajes
    }
}
