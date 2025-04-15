import { Hidratable } from "@shared/entidad/Hidratable"

export class Configuracion extends Hidratable {
    porcentaje_iva: number | null
    admite_pago_efectivo: string | null
    admite_pago_tarjeta: string | null
    admite_deposito_bancario: string | null
    url_pago_tarjeta: string | null
    numero_cuenta: string | null
    entidad_financiera: string | null
    propietario_cuenta: string | null
    identificacion_propietario_cuenta: string | null
    numero_contacto: string | null
    whatsapp: string | null
    facebook: string | null
    instagram: string | null
    twitter: string | null

    constructor() {
        super()
        this.porcentaje_iva = null
        this.admite_pago_efectivo = null
        this.admite_pago_tarjeta = null
        this.admite_deposito_bancario = null
        this.url_pago_tarjeta = null
        this.numero_cuenta = null
        this.entidad_financiera = null
        this.propietario_cuenta = null
        this.identificacion_propietario_cuenta = null
        this.numero_contacto = null
        this.whatsapp = null
        this.facebook = null
        this.instagram = null
        this.twitter = null
    }
}
