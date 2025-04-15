import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class DepositoTransferenciaController extends TransaccionController {
    constructor() {
        super(endpoints.depositos_transferencias)
    }
}
