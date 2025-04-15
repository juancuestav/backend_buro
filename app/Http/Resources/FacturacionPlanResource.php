<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class FacturacionPlanResource extends JsonResource
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
            'cliente' => $this->usuarios->name . ' ' . $this->usuarios->apellidos,
            'identificacion' => $this->usuarios->identificacion,
            'pagado' => $this->pagado,
            'fecha_pago' => $this->fecha_pago,
            'proximo_pago' => $this->proximo_pago,
        ];
    }
}
