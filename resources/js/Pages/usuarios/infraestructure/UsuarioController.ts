import { endpoints } from "@config/api.config"
import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"

export class UsuarioController extends TransaccionController {
    constructor() {
        super(endpoints.usuarios)
    }
}
