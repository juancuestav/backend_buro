<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarpetaResource extends JsonResource
{
	// public static $wrap = 'carpetas';
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		$usuario = $this->usuarios;

		return [
			'id' => $this->id,
			'nombre' => $this->nombre,
			'id_carpeta_padre' => $this->id_carpeta_padre,
			'usuario' => $usuario?->name . ' ' . $usuario?->apellidos,
		];
	}
}
