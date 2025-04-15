import { Hidratable } from "@shared/entidad/Hidratable"

export class Rol extends Hidratable {
    id: number | null
    name: number | null

    constructor() {
        super()
        this.id = null
        this.name = null
    }
}
