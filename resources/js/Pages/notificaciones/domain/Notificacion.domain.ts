import { Hidratable } from "@shared/entidad/Hidratable"

export class Notificacion extends Hidratable {
    id: string | null
    data: string | null

    constructor() {
        super()
        this.id = null
        this.data = null
    }
}
