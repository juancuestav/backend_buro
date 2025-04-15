<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\Score;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ReporteController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.crear.reportes')->only(['page', 'show', 'store']);
    }

    // Pagina Vue
    /* public function page()
    {
        return Inertia::render('reportes/view/ReportePage.vue');
    } */
    public function index(Request $request)
    {
        $usuario = $request['usuario'];
        $results = [];

        if ($usuario) {
            $results = Reporte::where('usuario', $usuario)->get()->map(fn($item) => [
                'id' => $item->id,
                'cliente' => $item->usuarios->name . ' ' . $item->usuarios->apellidos ?? '',
                'fecha' => Carbon::parse($item->created_at)->format('d-m-Y h:m:s'),
            ]);
        }
        return response()->json(compact('results'));
    }

    /**
     * POST: Recibe la data del reporte y lo guarda.
     */
    public function store(Request $request)
    {
        $usuario = $request['reporte']['usuario'];

        if (!isset($usuario)) {
            return response()->json(['mensaje' => 'Debe seleccionar a un cliente'], 422);
        }

        $data = $request['reporte'];
        $usuario = $request['reporte']['usuario'];

        $reporte = new Reporte();
        $reporte->reporte = json_encode($data);
        $reporte->usuario = $usuario;
        $reporte->save();

        $scoresRegistrados = Score::where('usuario', $usuario)->first();
        if ($scoresRegistrados) {
            $scoresRegistrados->score_crediticio = $data['score_crediticio'];
            $scoresRegistrados->score_sobreendeudamiento = $data['score_sobreendeudamiento'];
            $scoresRegistrados->save();
        } else {
            Score::create([
                'score_crediticio' => $data['score_crediticio'],
                'score_sobreendeudamiento' => $data['score_sobreendeudamiento'],
                'usuario' => $usuario
            ]);
        }

        return response()->json(['mensaje' => 'Reporte guardado exitosamente!']);
    }


    public function show(Request $request, Reporte $reporte)
    {
        return response()->json(compact('reporte'));
    }

    public function update(Request $request, Reporte $reporte)
    {
        $data = $request['reporte'];
        $usuario = $request['reporte']['usuario'];

        $reporte->reporte = json_encode($data);
        $reporte->usuario = $usuario;
        $reporte->save();
        return response()->json(['mensaje' => 'Reporte actualizado exitosamente!']);
    }

    public function destroy(Reporte $reporte)
	{
		$reporte->delete();
		return response()->json(['mensaje' => 'Reporte eliminado exitosamente!']);
	}
}
