import { Hidratable } from "@shared/entidad/Hidratable";

export class DepositoTransferencia extends Hidratable {
    id: number | null;
    cuenta: string | null;
    motivo: string | null;
    es_deposito: boolean;
    monto: number | null;
    comprobante: string | null;
    fecha_transaccion: string | null;
    tipo_transferencia: string | null;
    pedido: number | null;
    imagen: ArrayBuffer | string | null;

    constructor() {
        super();
        this.id = null;
        this.cuenta = null;
        this.motivo = null;
        this.es_deposito = true;
        this.monto = null;
        this.comprobante = null;
        this.fecha_transaccion = null;
        this.tipo_transferencia = null;
        this.pedido = null;
        this.imagen = null;
    }
}
