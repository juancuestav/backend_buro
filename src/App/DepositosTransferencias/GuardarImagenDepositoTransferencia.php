<?php

namespace Src\App\DepositosTransferencias;

use App\Models\DepositoTransferencia;
use Src\Shared\GuardarImagen;
use Src\Config\RutasStorage;

class GuardarImagenDepositoTransferencia extends GuardarImagen
{
	public function __construct(DepositoTransferencia $model, string $imagen_base64)
	{
		$ruta_imagen = RutasStorage::COMPROBANTES;
		parent::__construct($model, $imagen_base64, $ruta_imagen);
	}
}
