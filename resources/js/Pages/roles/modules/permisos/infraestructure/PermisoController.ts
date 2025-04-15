import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { Endpoint } from "@shared/http/Endpoint"

export class PermisoController extends TransaccionController {
    constructor(ruta: Endpoint) {
        super(ruta)
    }
}
