import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class PedidoController extends TransaccionController {
    constructor() {
        super(endpoints.pedidos)
    }
}
