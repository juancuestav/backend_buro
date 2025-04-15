export const configuracionColumnasEstablecimientos = [
    {
        title: "No. Establecimiento",
        field: "establecimiento",
        headerSort: false,
        editor: "input",
        width: 160,
        editorParams: { mask: "999" },
    },
    {
        title: "Nombre comercial",
        field: "nombre_comercial",
        headerSort: false,
        editor: "input",
        minWidth: 200,
    },
    {
        title: "Ubicación",
        field: "ubicacion",
        headerSort: false,
        editor: "input",
        minWidth: 200,
    },
    {
        title: "Estado",
        field: "estado",
        headerSort: false,
        editor: "list",
        minWidth: 100,
        editorParams: {
            allowEmpty: false,
            listOnEmpty: true,
            valuesLookup: true,
            values: { Abierto: "ABIERTO", Cerrado: "CERRADO" },
        },
    },
]
