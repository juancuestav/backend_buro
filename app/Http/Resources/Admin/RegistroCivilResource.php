<?php

namespace App\Http\Resources\Admin;

use App\Models\Admin\CondicionCivil;
use App\Models\Admin\EstadoCivil;
use App\Models\Admin\PuestoOcupacion;
use App\Models\Admin\RegistroCivilInstruccion;
use App\Models\Admin\RegistroCivilPais;
use App\Models\Admin\Sexo;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistroCivilResource extends JsonResource
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
            // 'id' => $this['id'],
            'cedula' => $this->cedula,
            'apellidos_nombres' => $this->apellidos_nombres,
            'sexo' => Sexo::find($this->sexo_id)->descripcion,
            'condicion' => CondicionCivil::find($this->condicion_id)?->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'pais' => RegistroCivilPais::find($this->pais_id)?->nombre,
            'estado_civil' => EstadoCivil::find($this->estado_civil_id)?->descripcion,
            'conyugue' => $this->conyugue,
            'cedula_conyugue' => $this->cedula_conyugue,
            'instruccion' => RegistroCivilInstruccion::find($this->instruccion_id)?->nombre,
            'codigo_dactilar' => $this->codigo_dactilar,
            'fecha_emision' => Carbon::parse($this->fecha_emision)->format('Y-m-d'),
            'apellidos_nombres_padre' => $this->apellidos_nombres_padre,
            'fecha_nacimiento' => Carbon::parse($this->fecha_nacimiento)->format('Y-m-d'),
            'pais_padre_id' => $this->pais_padre_id,
            'cedula_padre' => $this->cedula_padre,
            'apellidos_nombres_madre' => $this->apellidos_nombres_madre,
            'pais_madre_id' => $this->pais_madre_id,
            'cedula_madre' => $this->cedula_madre,
            'direccion' => $this->direccion,
            'puesto_ocupacion' => PuestoOcupacion::find($this->puesto_ocupacion_id)?->nombre,
            'fecha_matrimonio' => $this->fecha_matrimonio, 
        ];
    }
}
