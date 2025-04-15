import { Hidratable } from "@shared/entidad/Hidratable"

export class Mejoramiento extends Hidratable {
    id: number | null
    cliente: string | null
    identificacion_cliente: string | null
    estado: string | null
    deudas_vencidas: string | null
    puntaje_actual: string | null
    puntaje_subir: string | null
    fecha: string | null

    constructor() {
        super()
        this.id = null
        this.cliente = null
        this.identificacion_cliente = null
        this.estado = null
        this.deudas_vencidas = null
        this.puntaje_actual = null
        this.puntaje_subir = null
        this.fecha = null
    }
}
