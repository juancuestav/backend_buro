export class ItemOperacionCancelada {
    institucion: string
    numero_operaciones: number
    valor_original: number
    forma_cancelacion: string
    fecha_cancelacion: string

    constructor() {
        this.institucion = ""
        this.numero_operaciones = 0
        this.valor_original = 0
        this.forma_cancelacion = ""
        this.fecha_cancelacion = ""
    }
}
