<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\ArchivoResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccesoDirectoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'titulo' => $this['titulo'],
            'link' => $this['link'],
            'descripcion' => $this['descripcion'],
            'nueva_pestana' => $this['nueva_pestana'],
            'imagen' => $this['imagen'] ? url($this['imagen']) : null,
            'archivos' => ArchivoResource::collection($this['archivos']),
        ];
    }
}
