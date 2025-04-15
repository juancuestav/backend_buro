import { Hidratable } from "@shared/entidad/Hidratable"
import { Cliente } from "./Cliente"
import { LineaPedido } from "./LineaPedido"

export class Pedido extends Hidratable {
    id: number | null
    pedido: string | null
    cliente: Cliente | string | null
    fecha_emision: number | null
    estado_pago: string | null
    subtotal: number
    total: number
    servicio: string | null
    pago_cliente: number
    metodo_pago: string | null
    iva: number
    lineas_pedido: LineaPedido[]
    comentario: string | null
    deposito_transferencia: number | null
    tiene_reporte: string | null
    conoce_puntaje: string | null
    tiene_deudas: string | null
    es_cliente: string | null

    constructor() {
        super()
        this.id = null
        this.pedido = null
        this.cliente = null
        this.fecha_emision = null
        this.estado_pago = null
        this.subtotal = 0
        this.total = 0
        this.pago_cliente = 0
        this.metodo_pago = null
        this.servicio = null
        this.iva = 0
        this.lineas_pedido = []
        this.comentario = null
        this.deposito_transferencia = null
        this.tiene_reporte = null
        this.conoce_puntaje = null
        this.tiene_deudas = null
        this.es_cliente = null
    }
}
