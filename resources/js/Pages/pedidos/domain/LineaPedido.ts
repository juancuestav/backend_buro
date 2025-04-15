import { Hidratable } from "@shared/entidad/Hidratable"

export class LineaPedido extends Hidratable {
    id: number | null
    precio: number
    pedido: number | null
    servicio: string | number | null

    constructor() {
        super()
        this.id = null
        this.precio = 0
        this.pedido = null
        this.servicio = null
    }
}
