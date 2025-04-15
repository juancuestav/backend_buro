import { Hidratable } from "@/shared/entidad/Hidratable"

export class Carpeta extends Hidratable {
    id: number | null
    nombre: string | null
    id_carpeta_padre: number | null
    usuario: number | null

    constructor() {
        super()
        this.id = null
        this.nombre = null
        this.id_carpeta_padre = null
        this.usuario = null
    }
}
