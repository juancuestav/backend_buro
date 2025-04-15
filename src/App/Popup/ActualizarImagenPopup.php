<?php

namespace Src\App\Popup;

use App\Models\Popup;
use Src\Config\RutasStorage;
use Src\Shared\ActualizarImagen;

class ActualizarImagenPopup extends ActualizarImagen
{
	public function __construct(Popup $model, String | null $imagen_base64)
	{
		$ruta_imagen = RutasStorage::POPUP;
		parent::__construct($model, $imagen_base64, $ruta_imagen, privado: false);
	}
}
