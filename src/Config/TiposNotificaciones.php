<?php

namespace Src\Config;

// Ayuda al frontend a seleccionar el icono de acuerdo al tipo
enum TiposNotificaciones: string
{
    // Administrador y SuperAdmnistrador
    case FORMULARIO_CONTACTO = 'FORMULARIO DE CONTACTO';
    // Clientes
    case NOVEDADES = 'NOVEDADES';
    case ARCHIVO_REPORTE = 'BURO DE CREDITO';
}
