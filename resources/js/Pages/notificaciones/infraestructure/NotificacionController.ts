import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class NotificacionController extends TransaccionController {
    constructor() {
        super(endpoints.notificaciones)
    }
}
