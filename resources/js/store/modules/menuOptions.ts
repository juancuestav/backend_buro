import { getEndpoint } from "@shared/http/utils"
import { endpoints } from "@config/api.config"
import can from "@/mixins/Permissions"

export default {
    namespaced: true,
    state: {
        menu: [
            {
                route: getEndpoint(endpoints.dashboard),
                icon: "bi-house-fill",
                title: "Dasboard",
                can: can("puede.ver.dashboard"),
            },
            {
                route: getEndpoint(endpoints.notificaciones) + "page",
                icon: "bi-bell-fill",
                title: "Notificaciones",
                can: can("puede.recibir.notificaciones"),
            },
            {
                route: getEndpoint(endpoints.accesos_directos) + "page",
                icon: "bi-folder-symlink-fill",
                title: "Acceso a consultas",
                can: can("puede.ver.consultar"),
            },
            {
                route: "", //getEndpoint(endpoints.reportes) + "page",
                icon: "bi-clipboard-data-fill",
                title: "Reportes",
                can: can("puede.crear.reportes"),
                children: [
                    {
                        title: "Crear reporte",
                        route: getEndpoint(endpoints.reportes) + "page",
                    },
                    {
                        title: "Consultar reportes",
                        route:
                            getEndpoint(endpoints.consultar_reportes) + "page",
                    },
                ],
            },
            {
                route: getEndpoint(endpoints.gestor_archivos) + "page",
                icon: "bi-folder-fill",
                title: "Gestor de archivos",
                can: can("puede.ver.gestor_archivos"),
            },
            {
                route: getEndpoint(endpoints.activar_app) + "page",
                icon: "bi-toggle-on",
                title: "Activar app",
                can: can("puede.ver.activar_app"),
            },
            {
                route: getEndpoint(endpoints.solicitudes_mejoramiento) + "page",
                icon: "bi-graph-up-arrow",
                title: "Solicitudes mejoramiento",
                can: can("puede.editar.mejoramiento"),
            },
            {
                route: getEndpoint(endpoints.mejoramiento) + "page",
                icon: "bi-graph-up-arrow",
                title: "Mejoramiento",
                can: can("puede.ver.mejoramiento"),
            },
            {
                route: getEndpoint(endpoints.mis_reportes) + "page",
                icon: "bi-clipboard-data-fill",
                title: "Mis Reportes",
                can: can("puede.ver.mis_reportes"),
            },
            {
                route: getEndpoint(endpoints.servicios) + "page",
                icon: "bi-person-workspace",
                title: "Planes y servicios",
                can: can("puede.ver.servicios"),
            },
            {
                route: getEndpoint(endpoints.categorias) + "page",
                icon: "bi-collection",
                title: "Categorías",
                can: can("puede.ver.categorias"),
            },
            {
                route: getEndpoint(endpoints.usuarios) + "page",
                icon: "bi-people-fill",
                title: "Usuarios",
                can: can("puede.ver.usuarios"),
            },
            {
                route: getEndpoint(endpoints.facturacion_planes) + "page",
                icon: "bi-receipt",
                title: "Facturación planes",
                can: can("puede.ver.servicios"),
            },
            {
                route: getEndpoint(endpoints.pedidos) + "page",
                icon: "bi-clipboard-fill",
                title: "Pedidos de servicios",
                can: can("puede.ver.pedidos"),
            },
            {
                route: getEndpoint(endpoints.marketings) + "page",
                icon: "bi-envelope-check-fill",
                title: "Email marketing",
                can: can("puede.ver.pedidos"),
            },
            /* {
                route: getEndpoint(endpoints.mis_pedidos) + "page",
                icon: "bi-clipboard",
                title: "Mis pedidos",
            }, */
            /*  {
                route: getEndpoint(endpoints.entidades_financieras) + "page",
                icon: "bi-building",
                title: "Entidades financieras",
                can: can("puede.ver.entidades_financieras"),
            }, */
            /* {
                route: "/ventas",
                icon: "bi-receipt",
                title: "Ventas",
                children: [
                    { title: "Nueva venta", route: "/nueva-venta" },
                    { title: "Editar venta", route: "/editar-venta" },
                ],
            },
            {
                route: "/deudas",
                icon: "bi-bag-check",
                title: "Deudas",
                children: [
                    {
                        title: "Nuevo deuda",
                        route: "/nueva-deuda",
                    },
                    {
                        title: "Editar deuda",
                        route: "/editar-deuda",
                    },
                ],
            },
            {
                route: "/sistema",
                icon: "bi-hdd-stack",
                title: "Sistema",
                children: [
                    { title: "Negocio", route: "/negocios" },
                    { title: "Empleados", route: "/empleados" },
                ],
            }, */
            {
                route: getEndpoint(endpoints.popup) + "page",
                icon: "bi-badge-ad",
                title: "Popup",
                can: can("puede.ver.popup"),
            },
            {
                route: getEndpoint(endpoints.roles) + "page",
                icon: "bi-sliders",
                title: "Roles y permisos",
                can: can("puede.ver.roles_permisos"),
            },
            {
                route: getEndpoint(endpoints.perfil) + "page",
                icon: "bi-person-fill",
                title: "Perfil",
                can: can("puede.ver.perfil"),
            },
            /* {
                route: getEndpoint(endpoints.cambiar_contrasena) + "page",
                icon: "bi-key-fill",
                title: "Cambiar contraseña",
            }, */
            {
                route: getEndpoint(endpoints.chat_en_linea) + "page",
                icon: "bi-whatsapp",
                title: "Chat en línea",
                can: can("puede.ver.chat_linea"),
            },
            {
                route: getEndpoint(endpoints.notificaciones_cliente) + "page",
                icon: "bi-chat-dots-fill",
                title: "Notificaciones clientes",
                can: can("puede.ver.notificaciones_clientes"),
            },
            {
                route: getEndpoint(endpoints.notificaciones_generales) + "page",
                icon: "bi-bell-fill",
                title: "Notificaciones",
                can: can("puede.ver.notificaciones_generales"),
            },
            {
                route: getEndpoint(endpoints.configuraciones) + "page",
                icon: "bi-gear-fill",
                title: "Configuración",
                can: can("puede.ver.configuracion"),
            },
        ],
    },
}
