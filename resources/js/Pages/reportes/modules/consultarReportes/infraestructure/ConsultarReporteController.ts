import { endpoints } from "@config/api.config"
import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"

export class ConsultarReporteController extends TransaccionController {
    constructor() {
        super(endpoints.consultar_reportes)
    }
}
