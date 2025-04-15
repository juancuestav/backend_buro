<?php

namespace Src\App\Servicios;

use App\Models\Servicio;
use Src\Config\RutasStorage;
use Src\Shared\ActualizarImagen;

class ActualizarImagenServicio extends ActualizarImagen
{
	public function __construct(Servicio $model, String | null $imagen_base64)
	{
		$ruta_imagen = RutasStorage::SERVICIOS;
		parent::__construct($model, $imagen_base64, $ruta_imagen, privado: false);
	}
}
