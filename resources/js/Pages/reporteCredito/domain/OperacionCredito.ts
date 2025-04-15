export class OperacionCredito {
    institucion: string
    fecha_corte: string
    tipo_riesgo: string
    tipo_credito: string
    cupo_monto_original: number
    fecha_apertura: string
    fecha_vencimiento: string
    total_vencer: number
    ndi: string
    total_vencido: number
    demanda_judicial: string
    cartera_castigada: string
    saldo_deuda: number
    cuota_mensual: number

    constructor() {
        this.institucion = ""
        this.fecha_corte = ""
        this.tipo_riesgo = ""
        this.tipo_credito = ""
        this.cupo_monto_original = 0
        this.fecha_apertura = ""
        this.fecha_vencimiento = ""
        this.total_vencer = 0
        this.ndi = ""
        this.total_vencido = 0
        this.demanda_judicial = ""
        this.cartera_castigada = ""
        this.saldo_deuda = 0
        this.cuota_mensual = 0
    }
}
