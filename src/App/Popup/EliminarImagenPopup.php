<?php

namespace Src\App\Popup;

use App\Models\Popup;
use Src\Shared\EliminarImagen;

class EliminarImagenPopup extends EliminarImagen
{
	public function __construct(Popup $model)
	{
		parent::__construct($model, privado: false);
	}
}
