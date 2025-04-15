<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

class UsuarioResource extends BaseResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function construirModelo($request)
    {
        $controller_method = request()->route()->getActionMethod();
        $userProfile = $this->userProfile;

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
            'codigo_verificacion' => $this->codigo_verificacion,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'verificado' => !!$this->email_verified_at,
            'codigo_reclutador' => $this->codigo_reclutador,
            'rol' => implode(', ', $this->getRoleNames()->toArray()),
            'puede_recibir_notificaciones' => $this->can('puede.recibir.notificaciones'),
            'created_at' =>  Carbon::parse($this->created_at)->format('d-m-Y  H:i:s'),
            'user_profile_id' => $userProfile->id,
            'provincia' => $userProfile->provincia?->nombre,
            'canton' => $userProfile->canton?->nombre,
            'tipo_cliente' => $userProfile->tipo_cliente,
        ];

        if ($controller_method == 'show') {
            $modelo['rol'] = Role::select('id')->whereIn('name', $this->getRoleNames())->pluck('id')->toArray(); //->pluck('id');
            $modelo['provincia'] = $userProfile->provincia_id;
            $modelo['canton'] = $userProfile->canton_id;
            $modelo['limite_consultas'] = $this->userProfile->limite_consultas;
            $modelo['consultas_realizadas'] = $this->consultasRealizadas();
        }

        return $modelo;
    }
}
