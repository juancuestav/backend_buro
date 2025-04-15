<?php

namespace Src\Config;

enum RutasStorage: string
{
    // Sistema
    case CONFIGURACION_GENERAL = 'public/configuracion_general';

    // Private
    case GESTOR_ARCHIVOS = 'private/GestorArchivos';
    case COMPROBANTES = 'private/comprobantes/';
    // Public
    case SERVICIOS = 'public/servicios/';
    case POPUP = 'public/popup/';
    case RETIRO_COMPLETADO = 'public/retiros_completados/';
    // Usuarios
    case VERIFICAR_CUENTA = 'public/verificar_cuentas/';
    case ARCHIVOS_REPORTES = 'public/archivos_reportes/';
    // ACCESOS_DIRECTOS
    case ACCESOS_DIRECTOS = 'public/accesos_directos/';
    case ARCHIVOS_ACCESOS_DIRECTOS = 'public/archivos_accesos_directos/';
}
