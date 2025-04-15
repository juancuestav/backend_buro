import { Ref } from "vue"

// Botones
const btnQuitar = function (cell, formatterParams) {
    return `<span class="btn btn-danger btn-sm"><i class='bi-trash'></i></span>`
}

export class EventosTablaEliminar {
    private listado: Ref<any[]>

    constructor(listado: Ref<any[]>) {
        this.listado = listado
    }

    obtenerBotonesEventos() {
        const listado = this.listado

        return [
            {
                formatter: btnQuitar,
                hozAlign: "center",
                maxWidth: 62,
                headerSort: false,
                cellClick: function (e, cell) {
                    const indice = cell.getRow().getPosition()
                    listado.value.splice(indice, 1)
                    listado.value = [...listado.value]
                },
            },
        ]
    }
}
