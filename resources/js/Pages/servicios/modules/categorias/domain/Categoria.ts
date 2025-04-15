import { Hidratable } from "@shared/entidad/Hidratable"

export class Categoria extends Hidratable {
    id: number | null
    nombre: string | null
    orden: number | null

    constructor() {
        super()
        this.id = null
        this.nombre = null
        this.orden = null
    }
}
