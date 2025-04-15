<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicioResource extends JsonResource
{
    public static $wrap = null;
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		$controller_method = request()->route()->getActionMethod();

		$modelo = [
			'id' => $this->id,
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
			'estado' => $this->estado,
			'precio_unitario' => $this->precio_unitario,
			'gravable' => $this->gravable ? 'Incluido' : null,
			'iva' => $this->iva,
			'nombre_categoria' => $this->categorias?->nombre,
			'tipo_servicio' => $this->tipo_servicio,
			'url_video' => $this->url_video,
			'url_destino' => $this->url_destino,
			'url_paypal' => $this->url_paypal,
			'imagen' => $this->images?->url ? url($this->images?->url) : null,//url('img/logo.webp'),
		];

		if ($controller_method == 'show') {
			$modelo['gravable'] = $this->gravable;
			$modelo['categoria'] = $this->categoria;
		}
		return $modelo;
	}
}
