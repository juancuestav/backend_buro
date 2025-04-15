import { ContenedorMixin } from "../../contenedorMixin/ContenedorMixin"
import { acciones } from "@config/utils.config"
import { Ref } from "vue"

// Botones
const btnConsultar = function (cell, formatterParams) {
    return `<span class="btn btn-sm btn-light"><i class='bi-eye'></i></span>`
}
const btnEditar = function (cell, formatterParams) {
    return `<span class="btn btn-sm btn-light"><i class='bi-pencil'></i></span>`
}
const btnEliminar = function (cell, formatterParams) {
    return `<span class="btn btn-sm btn-light"><i class='bi-trash'></i></span>`
}

export class EventosTabla {
    private mixin: ContenedorMixin
    private accion: Ref
    private eventosAdmitidos: any

    constructor(mixin: ContenedorMixin, accion: Ref, eventosAdmitidos: any) {
        this.mixin = mixin
        this.accion = accion
        this.eventosAdmitidos = eventosAdmitidos
    }

    private obtenerAccionesTabla() {
        const { consultar } = this.mixin.useComportamiento()
        return {
            eliminar: (datos: any) => {
                this.accion.value = acciones.eliminar
                consultar(datos)
            },
            consultar: (datos: any) => {
                this.accion.value = acciones.consultar
                consultar(datos)
            },
            editar: (datos: any) => {
                this.accion.value = acciones.modificar
                consultar(datos)
            },
        }
    }

    obtenerBotonesEventos() {
        const accionesTabla = this.obtenerAccionesTabla()
        const eventos: any = []

        if (this.eventosAdmitidos.consultar) {
            eventos.push({
                formatter: btnConsultar,
                hozAlign: "left",
                minWidth: 52,
                headerSort: false,
                responsive: 0,
                resizable: false,
                cellClick: function (e, cell) {
                    accionesTabla.consultar(cell.getRow().getData())
                },
            })
        }

        if (this.eventosAdmitidos.editar) {
            eventos.push({
                formatter: btnEditar,
                hozAlign: "left",
                minWidth: 52,
                headerSort: false,
                responsive: 0,
                resizable: false,
                cellClick: function (e, cell) {
                    accionesTabla.editar(cell.getRow().getData())
                },
            })
        }

        if (this.eventosAdmitidos.eliminar) {
            eventos.push({
                formatter: btnEliminar,
                hozAlign: "left",
                minWidth: 52,
                headerSort: false,
                responsive: 0,
                resizable: false,
                cellClick: function (e, cell) {
                    accionesTabla.eliminar(cell.getRow().getData())
                },
            })
        }

        return eventos
    }
}
