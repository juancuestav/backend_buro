import { estadosProducto } from "@config/utils.config"
import { Hidratable } from "@shared/entidad/Hidratable"

export class Servicio extends Hidratable {
    id: number | null
    nombre: string | null
    descripcion: string | null
    categoria: number | null
    estado: string | null
    precio_unitario: number
    gravable: boolean
    es_plan: boolean
    imagen: string | null | ArrayBuffer
    url_video: string | null
    url_destino: string | null

    constructor() {
        super()
        this.id = null
        this.nombre = null
        this.descripcion = null
        this.categoria = null
        this.estado = estadosProducto.borrador
        this.precio_unitario = 0
        this.gravable = true
        this.es_plan = false
        this.imagen = null
        this.url_video = null
        this.url_destino = null
    }
}
