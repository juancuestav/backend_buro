<?php

namespace Src\App\Servicios;

use App\Models\Tarea;
use Src\Config\RutasStorage;
use Src\Shared\GuardarImagen;

class GuardarImagenRetiroCompletado extends GuardarImagen
{
	public function __construct(Tarea $model, string $imagen_base64)
	{
		$ruta_imagen = RutasStorage::RETIRO_COMPLETADO;
		parent::__construct($model, $imagen_base64, $ruta_imagen);
	}
}
