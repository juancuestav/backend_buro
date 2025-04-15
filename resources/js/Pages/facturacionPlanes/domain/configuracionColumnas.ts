export const configuracionColumnas = [
    {
        title: "Identificación",
        field: "identificacion",
        vertAlign: "middle",
        headerFilter: "input",
    },
    {
        title: "Cliente",
        field: "cliente",
        vertAlign: "middle",
        headerFilter: "input",
    },
    {
        title: "Mes pagado",
        field: "pagado",
        vertAlign: "middle",
        formatter: "tickCross",
        headerFilter: "tickCross",
        headerFilterParams: { tristate: true },
        headerFilterEmptyCheck: function (value) {
            return value === null
        },
    },
    {
        title: "Fecha de último pago",
        field: "fecha_pago",
        vertAlign: "middle",
    },
    {
        title: "Fecha de próximo pago",
        field: "proximo_pago",
        vertAlign: "middle",
    },
]
