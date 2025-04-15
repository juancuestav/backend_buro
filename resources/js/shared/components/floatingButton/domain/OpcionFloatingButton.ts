export class OpcionFloatingButton {
    titulo: string
    icono: string
    accion: (idEntidad?: number) => void

    constructor(
        titulo: string,
        icono: string,
        accion: (idEntidad?: number) => void
    ) {
        this.titulo = titulo
        this.icono = icono
        this.accion = accion
    }
}
