import { Hidratable } from "@shared/entidad/Hidratable"

export class EntidadFinanciera extends Hidratable {
    id: number | null
    nombre: string | null
    tipo: string | null

    constructor() {
        super()
        this.id = null
        this.nombre = null
        this.tipo = null
    }
}
