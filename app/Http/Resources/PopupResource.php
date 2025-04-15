<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PopupResource extends JsonResource
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
			'titulo' => $this->titulo,
			'url_destino' => $this->url_destino,
			'nueva_pestana' => $this->nueva_pestana,
			'imagen' => url($this->images?->url) ?? url('img/logo.webp'),
		];
	}
}
