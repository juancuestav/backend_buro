export class Chat {
    mensaje: string
    es_whatsapp: boolean
    es_correo: boolean

    constructor() {
        this.mensaje = ""
        this.es_whatsapp = false
        this.es_correo = false
    }
}
