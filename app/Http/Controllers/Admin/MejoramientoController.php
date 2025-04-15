<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mejoramiento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class MejoramientoController extends Controller
{
    const MAX_SOLICITUDES_POR_MES = 3;

    public function __construct()
    {
        // $this->middleware('can:puede.ver.mejoramiento')->only(['index', 'page', 'show']);
    }

    // Pagina Vue
    public function index()
    {
        $results = Mejoramiento::where('usuario', Auth::id())->orderBy('created_at', 'DESC')->first();/*->map(fn ($item) => [
            'puntaje_actual' => $item->puntaje_actual,
            'deudas_vencidas' => $item->deudas_vencidas,
            'puntaje_subir' => $item->puntaje_subir,
            'maximo_subir' => $item->maximo_subir,
            'observacion' => $item->observacion,
            'estado' => $item->estado,
            'fecha' => Carbon::parse($item->created_at)->format('Y-m-d'),
        ]);*/
        $cantidadSolicitudesEnviadas = $this->cantidadSolicitudesEnviadas();

        if ($results) $results->fecha = Carbon::parse($results->created_at)->format('Y-m-d');
        // return Inertia::render('mejoramiento/view/MejoramientoPage.vue', compact('solicitud', 'cantidadSolicitudesEnviadas'));
        return response()->json(compact('results', 'cantidadSolicitudesEnviadas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'puntaje_actual' => 'required',
            'deudas_vencidas' => 'required',
            'puntaje_subir' => 'required',
        ]);

        $id = Auth::id();

        if (!$this->puedeAgregarSolicitud()) {
            return response()->json(['errors' => ['mensaje' => 'Sólo puede enviar tres solicitudes por mes!']], 422);
        }

        if ($this->tieneSolicitudesPendientes($id)) {
            return response()->json(['errors' => ['mensaje' => 'Ya tiene una solicitud pendiente o en proceso!']], 422);
        }

        $modelo = Mejoramiento::create([
            'puntaje_actual' => $request['puntaje_actual'],
            'deudas_vencidas' => $request['deudas_vencidas'],
            'puntaje_subir' => $request['puntaje_subir'],
            'maximo_subir' => $request['maximo_subir'],
            'observacion' => $request['observacion'],
            'estado' => 'PENDIENTE',
            'usuario' => $id
        ]);

        $modelo->fecha = Carbon::parse($modelo->created_at)->format('Y-m-d');
        return response()->json(['mensaje' => 'Solicitud enviada exitosamente!', 'modelo' => $modelo]);
    }

    private function puedeAgregarSolicitud()
    {
        return $this->cantidadSolicitudesEnviadas() < MejoramientoController::MAX_SOLICITUDES_POR_MES;
    }

    private function tieneSolicitudesPendientes(int $user_id)
    {
        $pendiente = Mejoramiento::where('usuario', $user_id)->where('created_at', '<=', Carbon::now())->whereIn('estado', [Mejoramiento::PENDIENTE, Mejoramiento::EN_PROCESO])->orderBy('created_at', 'DESC')->first();
        return isset($pendiente);
    }

    private function cantidadSolicitudesEnviadas()
    {
        $solicitudes = Mejoramiento::select('created_at')->where('usuario', Auth::id())->where('created_at', '<=', Carbon::now())->get();
        $contador = 0;
        foreach ($solicitudes as $solicitud) {
            if (Carbon::parse($solicitud->created_at)->format('M') == Carbon::now()->format('M')) {
                $contador++;
            }
        }

        return $contador;
    }
}
