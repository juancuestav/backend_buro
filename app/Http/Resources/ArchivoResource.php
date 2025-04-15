<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArchivoResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'nombre' => $this->nombre,
			'carpeta' => $this->carpeta,
			'tamanio_bytes' => $this->tamanio_bytes,
			'ruta' => url($this->ruta),
		];
	}
}
