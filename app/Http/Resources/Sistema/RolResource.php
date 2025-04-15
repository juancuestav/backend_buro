<?php

namespace App\Http\Resources\Sistema;

use Illuminate\Http\Resources\Json\JsonResource;

class RolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $controller_method = $request->route()->getActionMethod();
        $modelo = [
            'id' => $this->id,
            'name' => $this->name,
            'nombre' => $this->name,
        ];

        if ($controller_method == 'show') {
            $service = new EmpleadoService();
            $modelo['empleados'] = $service->getUsersWithRoles([$this->name], ['id', 'nombres', 'apellidos']);
        }

        return $modelo;
    }
}
