import {eventosTabla} from "./eventosTabla.domain"

export const configuracionColumnas = [
    {
        title: "Nombre",
        field: "name",
        sorter: "string",
        vertAlign: "middle",
        headerFilter: "input",
    },
    ...eventosTabla,
]
