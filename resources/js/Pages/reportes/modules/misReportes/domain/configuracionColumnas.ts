import { Inertia } from "@inertiajs/inertia"

const renderConsultarReporte = function (cell, formatterParams) {
    return `<span class="btn btn-light btn-sm"><i class='bi-eye me-2'></i>Consultar</span>`
}

export const configuracionColumnas = [
    {
        title: "ID",
        field: "id",
        vertAlign: "middle",
        visible: false,
    },
    {
        title: "Nombre",
        field: "nombre",
        vertAlign: "middle",
    },
    {
        title: "Ruta",
        field: "ruta",
		visible: false,
        vertAlign: "middle",
    },
    {
        formatter: renderConsultarReporte,
        hozAlign: "center",
        headerSort: false,
        vertAlign: "middle",
        responsive: 0,
        cellClick: function (e, cell) {
            const data = cell.getRow().getData()
            Inertia.get(data.ruta)
        },
    },
]
