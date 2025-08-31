<?php

namespace App\Http\Resources;

use App\Models\FacturacionPlan;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
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
        // Esta pagado
        $facturacion = FacturacionPlan::where('usuario', $this->id)->first();
        $pagado = $facturacion?->pagado;

        $modelo = [
            'id' => $this->id,
            'name' => $this->name,
            'apellidos' => $this->apellidos,
            'tipo_identificacion' => $this->tipo_identificacion,
            'identificacion' => $this->identificacion,
            'direccion' => $this->direccion,
            'edad' => $this->edad,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'celular' => $this->celular,
            // 'email_verified_at' => $this->email_verified_at,
            'codigo_verificacion' => $this->codigo_verificacion,
            'email' => $this->email,
            'email_verified_at' => Carbon::parse($this->email_verified_at)->format('Y-m-d H:i:s'),
            'rol' => implode(', ', $this->getRoleNames()->toArray()),
            'roles' => $this->getRoleNames(), // ->toArray()),
            'puede_recibir_notificaciones' => $this->can('puede.recibir.notificaciones'),
            'permisos' => $this->obtenerPermisos($this->id),
            'pagado' => $pagado,
            'estado_verificacion' => $this->estado_verificacion,
            'user_profile_id' => $this->userProfile->id,
            'limite_consultas' => $this->userProfile->limite_consultas,
            'link_verificacion' => $this->userProfile->link_verificacion,
            'consultas_realizadas' => $this->consultasRealizadas()
        ];

        return $modelo;
    }
}