<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ConsultarReporteController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('can:puede.consultar.reportes')->only(['index', 'page', 'show']);
		$this->middleware('can:puede.crear.reportes')->only('store');
		$this->middleware('can:puede.editar.reportes')->only('update');
		$this->middleware('can:puede.eliminar.reportes')->only('destroy'); */
	}

	// Pagina Vue
	public function page()
	{
		return Inertia::render('reportes/modules/consultarReportes/view/ConsultarReportePage.vue');
	}

	public function index(Request $request)
	{
		$results = [];
		$usuario = $request['usuario'];

		if ($usuario) {
			$results = Reporte::where('usuario', $usuario)->get();
		}
		return response()->json(compact('results'));
	}

	public function show(Request $request, $mis_reporte)
	{
		$reporte = Reporte::find($mis_reporte);

		$reporte->usuario = $reporte['usuario'];
		$reporte = json_decode($reporte->reporte);
		return Inertia::render('reportes/modules/consultarReportes/view/PreviewReporteCliente.vue', compact('reporte'));
	}

	public function edit(Request $request, Reporte $consultar_reporte)
	{
		$reporte = json_decode($consultar_reporte->reporte);
		$id = $consultar_reporte->id;
		$usuario = $consultar_reporte->usuario;

		return Inertia::render('reportes/modules/consultarReportes/view/FormularioReporte.vue', compact('reporte', 'id', 'usuario'));
	}

	public function update(Request $request, Reporte $consultar_reporte)
	{
		$data = $request['reporte'];
		$usuario = $request['reporte']['usuario'];

		$consultar_reporte->reporte = json_encode($data);
		$consultar_reporte->usuario = $usuario;
		$consultar_reporte->save();
		return response()->json(['mensaje' => 'Reporte actualizado exitosamente!']);
	}

	public function destroy(Reporte $consultar_reporte)
	{
		$consultar_reporte->delete();
		return response()->json(['mensaje' => 'Reporte eliminado exitosamente!']);
	}
}
