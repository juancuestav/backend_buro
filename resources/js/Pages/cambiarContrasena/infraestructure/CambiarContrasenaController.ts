import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class CambiarContrasenaController extends TransaccionController {
    constructor() {
        super(endpoints.cambiar_contrasena)
    }
}
