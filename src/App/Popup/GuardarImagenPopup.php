<?php

namespace Src\App\Popup;

use App\Models\Popup;
use Src\Config\RutasStorage;
use Src\Shared\GuardarImagen;

class GuardarImagenPopup extends GuardarImagen
{
	public function __construct(Popup $model, string $imagen_base64)
	{
		$ruta_imagen = RutasStorage::POPUP;
		parent::__construct($model, $imagen_base64, $ruta_imagen);
	}
}
