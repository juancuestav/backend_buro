<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Provincia;
use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;

class AdquirirServicioController extends Controller
{
    public function index()
    {
        $tipos_identificaciones = TipoIdentificacion::all();
        $provincias = Provincia::all();
        $ciudades = Ciudad::all();

        $si_no_nose = ['', 'SI', 'NO', 'NO SE'];
        $si_no = ['', 'SI', 'NO'];

        return view('adquirir_servicio', compact('tipos_identificaciones', 'provincias', 'ciudades', 'si_no_nose', 'si_no'));
    }

    
}
