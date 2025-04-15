@echo off
setlocal

rem Define las rutas de las carpetas que crearemos
set "basePath=.\storage\app"

rem Crear carpetas - Colocar aquí todas las carpetas a crear

rem Sistema
mkdir "%basePath%\public\configuracion_general"
mkdir "%basePath%\public\fotosPerfiles"
mkdir "%basePath%\public\firmas"

rem Tickets
mkdir "%basePath%\public\fotografias_seguimiento_tickets"
mkdir "%basePath%\public\archivos_seguimiento_tickets"
mkdir "%basePath%\public\tickets"

mkdir "%basePath%\private\GestorArchivos"
mkdir "%basePath%\private\comprobantes"
mkdir "%basePath%\public\servicios"
mkdir "%basePath%\public\popup"

echo Carpetas creadas exitosamente.
pause
