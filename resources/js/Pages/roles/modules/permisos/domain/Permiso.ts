import { Hidratable } from "@shared/entidad/Hidratable"

export class Permiso extends Hidratable {
    id: number | null
    name: number | null

    constructor() {
        super()
        this.id = null
        this.name = null
    }
}
