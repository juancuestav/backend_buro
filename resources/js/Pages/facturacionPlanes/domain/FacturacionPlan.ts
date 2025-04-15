export class FacturacionPlan {
    cliente: string
    pagado: boolean
    fecha_pago: string
    proximo_pago: string

    constructor() {
        this.cliente = ""
        this.pagado = false
        this.fecha_pago = ""
        this.proximo_pago = ""
    }
}
