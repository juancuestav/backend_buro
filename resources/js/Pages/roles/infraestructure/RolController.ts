import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class RolController extends TransaccionController {
    constructor() {
        super(endpoints.roles)
    }
}
