import { Ref } from "vue"
import { acciones } from "@config/utils.config"
import { ContenedorMixin } from "../../contenedorMixin/ContenedorMixin"

// Botones
const btnConsultar = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-eye me-2'></i>Gestionar</span>`
}

export class EventosTablaConsultar {
    private mixin: ContenedorMixin
    private accion: Ref

    constructor(mixin: ContenedorMixin, accion: Ref) {
        this.mixin = mixin
        this.accion = accion
    }

    private obtenerAccionesTabla() {
        const { consultar } = this.mixin.useComportamiento()
        return {
            consultar: (datos: any) => {
                this.accion.value = acciones.consultar
                consultar(datos)
            },
        }
    }

    obtenerBotonesEventos() {
        const accionesTabla = this.obtenerAccionesTabla()

        return [
            {
                formatter: btnConsultar,
                hozAlign: "center",
                minWidth: 120,
                headerSort: false,
                vertAlign: "middle",
                cellClick: function (e, cell) {
                    accionesTabla.consultar(cell.getRow().getData())
                },
            },
        ]
    }
}
