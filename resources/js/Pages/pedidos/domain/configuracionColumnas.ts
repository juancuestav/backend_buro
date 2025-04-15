import { estadosPago } from "@config/utils.config"
import { textToCapitalize } from "@shared/utils"

const renderEstadoPago = function (cell, formatterParams) {
    const data = cell.getValue()
    const texto = textToCapitalize(data)
    switch (data) {
        case estadosPago.pagado:
            return `<span><i class="bi-check-circle-fill text-success me-2"></i>${texto}</span>`
        case estadosPago.pagoPendiente:
            return `<span><i class="bi-check-circle text-secondary me-2"></i>${texto}</span>`
        case estadosPago.anulado:
            return `<span><i class="bi-emoji-frown text-danger me-2"></i>${texto}</span>`
    }
}

export const configuracionColumnas = [
    {
        title: "Pedido",
        field: "pedido",
        sorter: "number",
        vertAlign: "middle",
        headerFilter: "number",
        width: 100,
    },
    {
        title: "Fecha",
        field: "fecha_emision",
        sorter: "string",
        vertAlign: "middle",
        headerFilter: "input",
        width: 100,
    },
    {
        title: "Cliente",
        field: "cliente",
        sorter: "string",
        vertAlign: "middle",
        headerFilter: "input",
        minWidth: 120,
    },
    {
        title: "Estado pago",
        field: "estado_pago",
        sorter: "string",
        vertAlign: "middle",
        headerFilter: "input",
        formatter: renderEstadoPago,
    },
]
