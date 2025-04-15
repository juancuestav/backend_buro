<?php

namespace App\Http\Resources\Sistema;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PermisoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $controller_method = $request->route()->getActionMethod();

        $modelo = [
            'id' => $this['id'],
            'name' => $this['name'],
            'nombre' => $this['name'],
        ];

        if ($controller_method == 'show') {
            $modelo['roles'] = $this->roles()->pluck('name');
            $ids_users_inactivos = User::where('estado', false)->pluck('id');
            $modelo['empleados'] = User::whereNotIn('id', $ids_users_inactivos)->pluck('name');
        }
        return $modelo;
    }
}
