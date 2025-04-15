export const rolesPredeterminados = {
    ADMINISTRADOR: "ADMINISTRADOR",
    EMPLEADO: "EMPLEADO",
    CLIENTE: "CLIENTE",
}

export const tipoSeleccion = {
    UNA_FILA: 1,
    MULTIPLES_FILAS: true,
    NINGUNA: false,
}

export const acciones = {
    nuevo: "NUEVO",
    eliminar: "ELIMINAR",
    consultar: "CONSULTAR",
    modificar: "MODIFICAR",
}

export const estadosProducto = { borrador: "BORRADOR", activo: "ACTIVO" }

export const estadosProductoListado = [
    { id: "BORRADOR", descripcion: "Borrador" },
    { id: "ACTIVO", descripcion: "Activo" },
]

export const estadosSI_NO = [
    { id: "SI", descripcion: "Si" },
    { id: "NO", descripcion: "No" },
]

export const puntuaciones = [
    { id: "100", descripcion: "100" },
    { id: "200", descripcion: "200" },
    { id: "300", descripcion: "300" },
    { id: "400", descripcion: "400" },
    { id: "500", descripcion: "500" },
    { id: "600", descripcion: "600" },
    { id: "700", descripcion: "700" },
    { id: "800", descripcion: "800" },
    { id: "900", descripcion: "900" },
    { id: "1000", descripcion: "1000" },
]

export const estadosMejoramiento = [
    {
        id: "PENDIENTE",
        descripcion: "Pendiente",
    },
    {
        id: "EN PROCESO",
        descripcion: "En proceso",
    },
    {
        id: "APROBADO",
        descripcion: "Aprobado",
    },
    {
        id: "NEGADO",
        descripcion: "Negado",
    },
]

export const estados = [
    { id: "ACTIVO", descripcion: "Activo" },
    { id: "NO ACTIVO", descripcion: "No activo" },
]

export const metodosPago = {
    efectivo: "EFECTIVO",
    deposito: "DEPOSITO",
}

export const tiposTransferencias = [
    { id: "TRASPASO", descripcion: "Traspaso" },
    { id: "TRANSFERENCIA", descripcion: "Transferencia" },
]

export const tiposEntidadesFinancieras = [
    { id: "BANCO", descripcion: "Banco" },
    { id: "COOPERATIVA", descripcion: "Cooperativa de ahorro y crédito" },
    { id: "CAJA DE AHORRO", descripcion: "Caja de Ahorro" },
]

export const estadosPago = {
    pagado: "PAGADO",
    pagoPendiente: "PAGO PENDIENTE",
    anulado: "ANULADO",
}

export const estadosPreparacion = {
    noPreparado: "NO PREPARADO",
    preparado: "PREPARADO",
    parcialmentePreparado: "PARCIALMENTE PREPARADO",
}
