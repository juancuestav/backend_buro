import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class SelectorController extends TransaccionController {
    constructor(endpoint: keyof typeof endpoints) {
        super(endpoints[endpoint])
    }
}
