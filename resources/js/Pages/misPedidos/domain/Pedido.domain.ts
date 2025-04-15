import { Hidratable } from "@shared/entidad/Hidratable"

export class Pedido extends Hidratable {
    id: number | null
    pedido: string | null
    fecha_emision: number | null
    estado_pago: string | null
    direccion_envio: string | null
    tipo_pedido: string | null
    precio_envio: number
    subtotal: number
    total: number
    iva: number

    constructor() {
        super()
        this.id = null
        this.pedido = null
        this.fecha_emision = null
        this.estado_pago = null
        this.direccion_envio = null
        this.tipo_pedido = null
        this.precio_envio = 0
        this.subtotal = 0
        this.total = 0
        this.iva = 0
    }
}
