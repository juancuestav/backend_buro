<?php

namespace Src\App;

use App\Http\Resources\TareaResource;
use App\Models\Tarea;

class TareaService
{
    public function __construct()
    {
    }

    public function obtenerPaginacion($offset)
    {
        $filter = Tarea::ignoreRequest(['offset'])->filter()->where('fecha_hora_asignacion', '!=', null)->orderBy('fecha_hora_asignacion', 'asc')->simplePaginate($offset);
        TareaResource::collection($filter);
        return $filter;
    }

    public function obtenerTodasTareas()
    {
        $results = Tarea::filter()->where('tipo', Tarea::TAREA)->get();
        return TareaResource::collection($results);
    }

    public function obtenerTodosRetiros()
    {
        $results = Tarea::filter()->where('tipo', Tarea::RETIRO)->get();
        return TareaResource::collection($results);
    }
}
