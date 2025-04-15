import { Endpoint } from "@shared/http/Endpoint"

export const baseURL = window.location.origin + "/"

export const endpoints = {
    logout: new Endpoint("logout", false),

    dashboard: new Endpoint(""),
    admin_root: new Endpoint("/"),
    usuarios: new Endpoint("usuarios/"),
    clientes: new Endpoint("clientes/"),
    gestor_archivos: new Endpoint("gestor-archivos/"),
    carpetas: new Endpoint("carpetas/"),
    archivos: new Endpoint("archivos/"),
    perfil: new Endpoint("perfil/"),
    notificaciones_contacto: new Endpoint("notificaciones-contacto/"),
    notificaciones: new Endpoint("notificaciones/"),
    servicios: new Endpoint("servicios/"),
    categorias: new Endpoint("categorias/"),
    configuraciones: new Endpoint("configuraciones/"),
    pedidos: new Endpoint("pedidos/"),
    mis_pedidos: new Endpoint("mis-pedidos/"),
    depositos_transferencias: new Endpoint("depositos-transferencias/"),
    pedidos__registrar_pago_efectivo: new Endpoint(
        "pedidos/registrar-pago-efectivo/"
    ),
    pedidos__anular: new Endpoint("pedidos/anular"),
    entidades_financieras: new Endpoint("entidades-financieras/"),
    accesos_directos: new Endpoint("accesos-directos/"),
    popup: new Endpoint("popup/"),
    cambiar_contrasena: new Endpoint("cambiar-contrasena/"),
    chat_en_linea: new Endpoint("chat-en-linea/"),
    notificaciones_cliente: new Endpoint("notificaciones-cliente/"),
    notificaciones_generales: new Endpoint("notificaciones-generales/"),
    roles: new Endpoint("roles/"),
    permisos: new Endpoint("permisos/"),
    reportes: new Endpoint("reportes/"),
    mis_reportes: new Endpoint("mis-reportes/"),
    consultar_reportes: new Endpoint("consultar-reportes/"),
    activar_app: new Endpoint("activar-app/"),
    mejoramiento: new Endpoint("mejoramiento/"),
    solicitudes_mejoramiento: new Endpoint("solicitudes-mejoramiento/"),
    facturacion_planes: new Endpoint("facturacion-planes/"),
    marketings: new Endpoint("marketings/"),
    // Public endpoint
    mostrar_detalles_pedido: new Endpoint("carrito/pedido/", false),
}
