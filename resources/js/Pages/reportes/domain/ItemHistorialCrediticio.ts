export class ItemHistorialCrediticio {
    mes: string
    deuda_total: number
    deuda_vencida: number
    institucion: string
    observacion: string

    constructor() {
        this.mes = ""
        this.deuda_total = 0
        this.deuda_vencida = 0
        this.institucion = ""
        this.observacion = ""
    }
}
