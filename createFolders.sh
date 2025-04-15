#!/bin/bash

# Define la ruta base donde quieres crear las carpetas
BASE_PATH="./storage/app"

# Sistema
mkdir -p "$BASE_PATH/public/configuracion_general"
mkdir -p "$BASE_PATH/public/fotosPerfiles"
mkdir -p "$BASE_PATH/public/firmas"

# Tickets
mkdir -p "$BASE_PATH/public/tickets/fotografias_seguimiento_tickets"
mkdir -p "$BASE_PATH/public/tickets/archivos_seguimiento_tickets"
mkdir -p "$BASE_PATH/public/tickets/tickets"


mkdir -p "$BASE_PATH/public/GestorArchivos"
mkdir -p "$BASE_PATH/public/comprobantes"
mkdir -p "$BASE_PATH/public/servicios"
mkdir -p "$BASE_PATH/public/popup"

echo "Carpetas creadas exitosamente."
