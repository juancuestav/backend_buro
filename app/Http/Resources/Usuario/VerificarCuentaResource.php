<?php

namespace App\Http\Resources\Usuario;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VerificarCuentaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $usuario = $this->usuario;

        return [
            'id' => $this->id,
            'documento_identidad_anverso' => $this->documento_identidad_anverso ? url($this->documento_identidad_anverso) : null,
            'documento_identidad_reverso' => $this->documento_identidad_reverso ? url($this->documento_identidad_reverso) : null,
            'documento_identidad_selfie' => $this->documento_identidad_selfie ? url($this->documento_identidad_selfie) : null,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'usuario' => User::extraerNombresApellidos($usuario),
            'user_id' => $this->user_id,
            'estado_verificacion' => $usuario->estado_verificacion,
        ];
    }
}
