<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $id_mejoramiento = 2; // Debido a q la categoria Mejoramiento puede cambiar de ID se lo coloca manualmente
        $mejoramientos = Servicio::activo()->where('categoria', $id_mejoramiento)->get();

        $id_reportes = 1; // Debido a q la categoria Reportes puede cambiar de ID se lo coloca manualmente
        $reportes = Servicio::activo()->where('categoria', $id_reportes)->get();

        return view('planes.index', compact('mejoramientos', 'reportes'));
    }

    public function serviciosMejoramiento(Request $request)
    {
        $id_mejoramiento = 2; // Debido a q la categoria Mejoramiento puede cambiar de ID se lo coloca manualmente
        $mejoramientos = Servicio::activo()->where('categoria', $id_mejoramiento)->get();

        $id_reportes = 1; // Debido a q la categoria Reportes puede cambiar de ID se lo coloca manualmente
        $reportes = Servicio::activo()->where('categoria', $id_reportes)->get();

        return view('mejoramiento.index', compact('mejoramientos', 'reportes'));
    }

    public function show(Request $request, Servicio $plan)
    {
        return view('planes.show', compact('plan'));
    }
}
