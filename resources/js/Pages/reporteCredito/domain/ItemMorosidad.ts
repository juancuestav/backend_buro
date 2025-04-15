export class ItemMorosidad {
    acreedor: string
    por_vencer: string
    no_devenga_intereses: string
    vencido: string
    saldo_deuda: number

    constructor() {
        this.acreedor = ""
        this.por_vencer = ""
        this.no_devenga_intereses = ""
        this.vencido = ""
        this.saldo_deuda = 0
    }
}
