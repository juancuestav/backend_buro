import { estadosProducto } from "@config/utils.config"
import { textToCapitalize } from "@shared/utils"

const estadoRender = function (cell, formatterParams) {
    const data = cell.getValue()
    const texto = textToCapitalize(data)
    switch (data) {
        case estadosProducto.activo:
            return (
                '<span><i class="bi-check-circle-fill text-success me-2"></i>' +
                texto +
                "</span>"
            )
        case estadosProducto.borrador:
            return (
                '<span><i class="bi-check-circle-fill text-secondary me-2"></i>' +
                texto +
                "</span>"
            )
    }
}

export const configuracionColumnas = [
    {
        title: "Nombre",
        field: "nombre",
        sorter: "string",
        vertAlign: "middle",
        headerFilter: "input",
        minWidth: 240,
    },
    {
        title: "Estado",
        field: "estado",
        vertAlign: "middle",
        minWidth: 120,
        headerFilter: "list",
        headerFilterParams: {
            values: { BORRADOR: "Borrador", ACTIVO: "Activo", "": "" },
            clearable: true,
        },
        formatter: estadoRender,
    },
    {
        title: "Precio",
        field: "precio_unitario",
        sorter: "string",
        vertAlign: "middle",
        headerFilter: "input",
    },
    {
        title: "Gravable",
        field: "gravable",
        vertAlign: "middle",
        hozAlign: "center",
        visible: false,
        formatter: "tickCross",
        headerFilter: "tickCross",
        headerFilterParams: { tristate: true },
        headerFilterEmptyCheck: function (value) {
            return value === null
        },
    },
    {
        title: "IVA",
        field: "iva",
        sorter: "number",
        vertAlign: "middle",
        headerFilter: "number",
        visible: false,
    },
]
