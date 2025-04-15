import { Inertia } from "@inertiajs/inertia"
import { endpoints } from "@config/api.config"
import { getEndpoint } from "@/shared/http/utils"

// Botones
const btnEditar = function (cell, formatterParams) {
    return `<span class="btn btn-outline-secondary btn-sm"><i class='bi-gear me-2'></i>Permisos</span>`
}

// Funciones
const editarPermisos = (rol: any) => {
    const ruta = getEndpoint(endpoints.permisos) + rol.id
    Inertia.get(ruta)
}

export const eventosTabla = [
    {
        formatter: btnEditar,
        headerSort: false,
        hozAlign: "left",
        minWidth: 100,
        responsive: 0,
        cellClick: function (e, cell) {
            editarPermisos(cell.getRow().getData())
        },
    },
]
