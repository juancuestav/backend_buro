<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MejoramientoResource;
use App\Models\Mejoramiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SolicitudMejoramientoController extends Controller
{
    // Pagina Vue
    public function page()
    {
        return Inertia::render('solicitudesMejoramiento/view/SolicitudMejoramientoPage.vue');
    }

    public function index(Request $request)
    {
        $search = $request['estado'];
        $results = [];

        if ($search) {
            $results = Mejoramiento::orderBy('created_at', 'DESC')->where('estado', $search)->get()->map(fn ($item) => [
                'id' => $item->id,
                'cliente' => $item->usuarios->name . ' ' . $item->usuarios->apellidos ?? '',
                'celular' => $item->usuarios->celular,
                'estado' => $item->estado,
                'puntaje_actual' => $item->puntaje_actual,
                'puntaje_subir' => $item->puntaje_subir,
                'fecha' => Carbon::parse($item->created_at)->format('Y-m-d'),
            ]);
        } else {
            $results = Mejoramiento::orderBy('created_at', 'DESC')->get()->map(fn ($item) => [
                'id' => $item->id,
                'cliente' => $item->usuarios->name . ' ' . $item->usuarios->apellidos ?? '',
                'celular' => $item->usuarios->celular,
                'estado' => $item->estado,
                'puntaje_actual' => $item->puntaje_actual,
                'puntaje_subir' => $item->puntaje_subir,
                'fecha' => Carbon::parse($item->created_at)->format('Y-m-d'),
            ]);
        }

        return response()->json(compact('results'));
    }

    public function show(Mejoramiento $solicitudes_mejoramiento)
    {
        return response()->json(['modelo' => new MejoramientoResource($solicitudes_mejoramiento)]);
    }

    public function update(Request $request, Mejoramiento $solicitudes_mejoramiento)
    {
        $solicitudes_mejoramiento->update($request->all());
        return response()->json(['mensaje' => 'Solicitud actualizada exitosamente!', 'modelo' => new MejoramientoResource($solicitudes_mejoramiento)]);
    }

    public function destroy(Mejoramiento $solicitudes_mejoramiento)
    {
        $solicitudes_mejoramiento->delete();
        return response()->json(['mensaje' => 'Registro eliminado exitosamente!']);
    }
}
