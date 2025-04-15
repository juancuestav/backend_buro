import { Hidratable } from "@/shared/entidad/Hidratable"

export class Mejoramiento extends Hidratable {
    puntaje_actual: number | null
    deudas_vencidas: number | null
    puntaje_subir: number | null
    maximo_subir: number | null
    observacion: string | null
    estado: string | null
    fecha: string | null

    constructor() {
        super()
        this.puntaje_actual = null
        this.deudas_vencidas = null
        this.puntaje_subir = null
        this.maximo_subir = null
        this.observacion = null
        this.estado = null
        this.fecha = null
    }
}
