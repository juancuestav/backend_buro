import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class EntidadFinancieraController extends TransaccionController {
    constructor() {
        super(endpoints.entidades_financieras)
    }
}
