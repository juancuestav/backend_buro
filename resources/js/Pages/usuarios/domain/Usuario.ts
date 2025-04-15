import { Hidratable } from "@shared/entidad/Hidratable"

export class Usuario extends Hidratable {
    id: number | null
    name: string | null
    apellidos: string | null
    celular: string | null
    email: string | null
    tipo_identificacion: number | null
    identificacion: string | null
    password: string | null
    password_confirmation: string | null
    direccion: string | null
    edad: string | null
    rol: []
    puede_recibir_notificaciones: boolean

    constructor() {
        super()
        this.id = null
        this.name = null
        this.apellidos = null
        this.celular = null
        this.email = null
        this.tipo_identificacion = null
        this.identificacion = null
        this.password = null
        this.password_confirmation = null
        this.direccion = null
        this.edad = null
        this.rol = []
        this.puede_recibir_notificaciones = false
    }
}
