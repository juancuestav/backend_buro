<?php

namespace Src\App\Servicios;

use App\Models\Servicio;
use Src\Config\RutasStorage;
use Src\Shared\GuardarImagen;

class GuardarImagenServicio extends GuardarImagen
{
	public function __construct(Servicio $model, string $imagen_base64)
	{
		$ruta_imagen = RutasStorage::SERVICIOS;
		parent::__construct($model, $imagen_base64, $ruta_imagen);
	}
}
