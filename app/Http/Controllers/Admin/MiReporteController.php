<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MiReporteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.ver.mis_reportes')->only(['page', 'index', 'show']);
    }

    // Pagina Vue
    public function page()
    {
        // $categorias = Categoria::all();
        return Inertia::render('reportes/modules/misReportes/view/MiReportePage.vue');
    }

    public function index()
    {
        $results = Reporte::where('usuario', Auth::id())->get();
        return response()->json(compact('results'));
    }

    public function show(Request $request, $mis_reporte)
    {
        $reporte = Reporte::find($mis_reporte);
        $reporte->usuario = $reporte['usuario'];
        $reporte = json_decode($reporte->reporte);
        return Inertia::render('reportes/modules/previewReporteCliente/view/PreviewReporteCliente.vue', compact('reporte'));
    }
}
