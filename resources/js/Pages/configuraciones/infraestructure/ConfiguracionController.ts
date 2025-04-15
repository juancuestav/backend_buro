import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class ConfiguracionController extends TransaccionController {
    constructor() {
        super(endpoints.configuraciones)
    }
}
