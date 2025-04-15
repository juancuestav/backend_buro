import { TransaccionController } from "@shared/contenedor/infraestructure/TransaccionController"
import { endpoints } from "@config/api.config"

export class CategoriaController extends TransaccionController {
    constructor() {
        super(endpoints.categorias)
    }
}
