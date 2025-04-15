export class ItemVencimiento {
    acreedor: string
    fecha_corte: string
    tipo_riesgo: string
    saldo_deuda: number
    valor_por_vencer: number
    no_devenga_intereses: string
    valor_vencido: number
    demanda_judicial: string
    cartera_castigada: string
    tiempo_vencido_dias: number

    constructor() {
        this.acreedor = ""
        this.fecha_corte = ""
        this.tipo_riesgo = ""
        this.saldo_deuda = 0
        this.valor_por_vencer = 0
        this.no_devenga_intereses = ""
        this.valor_vencido = 0
        this.demanda_judicial = ""
        this.cartera_castigada = ""
        this.tiempo_vencido_dias = 0
    }
}
