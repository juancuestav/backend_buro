import { endpoints } from "@config/api.config"
import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"

export class SolicitudMejoramientoController extends TransaccionController {
    constructor() {
        super(endpoints.solicitudes_mejoramiento)
    }
}
