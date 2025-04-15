<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MejoramientoResource extends JsonResource
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
            'id' => $this->id,
            'cliente' => $this->usuarios->name . ' ' . $this->usuarios->apellidos ?? '',
            'identificacion_cliente' => $this->usuarios->identificacion,
            'celular' => $this->usuarios->celular,
            'estado' => $this->estado,
            'deudas_vencidas' => $this->deudas_vencidas,
            'maximo_subir' => $this->maximo_subir,
            'observacion' => $this->observacion,
            'puntaje_actual' => $this->puntaje_actual,
            'puntaje_subir' => $this->puntaje_subir,
            'fecha' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
