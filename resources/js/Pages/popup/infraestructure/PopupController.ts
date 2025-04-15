import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class PopupController extends TransaccionController {
    constructor() {
        super(endpoints.popup)
    }
}
