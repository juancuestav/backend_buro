export class OpcionDropdown {
    titulo: string
    accion: (idEntidad: number) => void

    constructor(titulo: string, accion: (idEntidad: number) => void) {
        this.titulo = titulo
        this.accion = accion
    }
}
