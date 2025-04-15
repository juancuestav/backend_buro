<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;

class SolucionesEmpresasController extends Controller
{
    public function index()
    {
        $solucionesEmpresas = Servicio::activo()->esSolucionesEmpresas()->get();

        return view('soluciones_empresas.index', compact('solucionesEmpresas'));
    }
}
