export class ItemHistorialCrediticio {
    mes: string | null
    deuda_total: number | null
    deuda_vencida: number | null
    institucion: string | null
    observacion: string | null

    constructor() {
        this.mes = null
        this.deuda_total = 0
        this.deuda_vencida = 0
        this.institucion = null
        this.observacion = null
    }
}
