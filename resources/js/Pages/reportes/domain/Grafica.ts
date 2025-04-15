import { GraficaDatos } from "./GraficaDatos"

export class Grafica {
    titulo: string
    color: string
    tipo: string
    datos: GraficaDatos[]

    constructor() {
        this.titulo = "Predeterminado"
        this.color = "#7aa815"
        this.tipo = "Bar"
        this.datos = []
    }
}
