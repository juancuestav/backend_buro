<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;

class ReporteCreditoController extends Controller
{
    public function index(Request $request)
    {
        $id_mejoramiento = 2; // Debido a q la categoria Mejoramiento puede cambiar de ID se lo coloca manualmente
        $mejoramientos = Servicio::activo()->where('categoria', $id_mejoramiento)->get();

        $id_reportes = 1; // Debido a q la categoria Reportes puede cambiar de ID se lo coloca manualmente
        $reportes = Servicio::activo()->where('categoria', $id_reportes)->get();

        return view('reporte_credito.index', compact('mejoramientos', 'reportes'));
    }
}
