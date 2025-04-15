export class ItemSaldoPorVencer {
    fecha: string
    institucion_financiera: string
    total_por_vencer: number
    por_vencer_1_30_dias: number
    por_vencer_1_3_meses: number
    por_vencer_3_6_meses: number
    por_vencer_6_12_meses: number
    por_vencer_mas_12_meses: number

    constructor() {
        this.fecha = ""
        this.institucion_financiera = ""
        this.total_por_vencer = 0
        this.por_vencer_1_30_dias = 0
        this.por_vencer_1_3_meses = 0
        this.por_vencer_3_6_meses = 0
        this.por_vencer_6_12_meses = 0
        this.por_vencer_mas_12_meses = 0
    }
}
