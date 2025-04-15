import { Hidratable } from "@shared/entidad/Hidratable"

export class Cliente extends Hidratable {
    id: number | null
    name: string | null
    apellidos: string | null
    celular: string | null
    email: string | null
    tipo_identificacion: number | null
    identificacion: string | null

    constructor() {
        super()
        this.id = null
        this.name = null
        this.apellidos = null
        this.celular = null
        this.email = null
        this.tipo_identificacion = null
        this.identificacion = null
    }
}
