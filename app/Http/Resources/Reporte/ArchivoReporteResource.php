<?php

namespace App\Http\Resources\Reporte;

use App\Http\Resources\ArchivoResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ArchivoReporteResource extends JsonResource
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
            'user' => $this->user_id,
            'subido_por_user' => $this->subido_por_user_id,
            'reporte' => $this->reporte_id,
            'created_at' =>  $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'archivos' => ArchivoResource::collection($this->archivos),
        ];
    }
}
