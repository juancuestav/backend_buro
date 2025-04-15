import { endpoints } from "@config/api.config"
import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"

export class MiReporteController extends TransaccionController {
    constructor() {
        super(endpoints.mis_reportes)
    }
}
