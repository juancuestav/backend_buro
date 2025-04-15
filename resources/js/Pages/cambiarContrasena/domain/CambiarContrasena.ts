import { Hidratable } from "@shared/entidad/Hidratable"

export class CambiarContrasena extends Hidratable {
    current_password: string | null
    password: string | null
    password_confirmation: string | null

    constructor() {
        super()
        this.current_password = null
        this.password = null
        this.password_confirmation = null
    }
}
