<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketingResource extends JsonResource
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
        return [
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'edad' => $this->edad,
            'provincia' => $this->provincias?->nombre,
            'ciudad' => $this->ciudades?->nombre,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'celular' => $this->celular,
            'tipo_identificacion' => $this->tipos_identificaciones->descripcion,
            'identificacion' => $this->identificacion,
        ];
    }
}
