import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class MiPedidoController extends TransaccionController {
    constructor() {
        super(endpoints.mis_pedidos)
    }
}
