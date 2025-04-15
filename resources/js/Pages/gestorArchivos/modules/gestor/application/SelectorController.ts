import { endpoints } from "@/config/api.config"
import { TransaccionController } from "@/shared/contenedor/infraestructure/TransaccionController"

export class SelectorController extends TransaccionController {
    constructor(endpoint: keyof typeof endpoints) {
        super(endpoints[endpoint])
    }
}
