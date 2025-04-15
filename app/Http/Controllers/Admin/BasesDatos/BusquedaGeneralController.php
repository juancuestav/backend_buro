<?php

namespace App\Http\Controllers\Admin\BasesDatos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\RegistroCivilResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BusquedaGeneralController extends Controller
{
    public function index()
    {
        if (request('export') == 'pdf') return $this->descargarReportePdf(request('search'));
        else {
            $results = $this->buscar(request('search'));
            return response()->json(compact('results'));
        }
    }

    private function buscar($identificacion)
    {
        // Establecer una bandera en la sesión para evitar el registro duplicado de auditoría
        Session::put('auditoria_registrada', true);

        $ruc = request('search') . '001';

        $registro_civil = DB::connection('sqlite_registro_civil')
            ->table('registro_civil')
            ->where('cedula', request('search'))
            ->first();

        if ($registro_civil) {
            $registro_civil = new RegistroCivilResource($registro_civil);
            $registro_civil = $registro_civil->resolve();
        } else $registro_civil = null;

        $banco = DB::connection('sqlite_banco')
            ->table('banco')
            ->where('cedula_ruc', request('search'))
            ->get();
        //$banco = $banco ? (array) $banco : null;

        $iess = DB::connection('sqlite_iess')
            ->table('iess')
            ->where('identificacion', request('search'))
            ->first();
        $iess = $iess ? (array) $iess : null;

        $sri = DB::connection('sqlite_sri')
            ->table('sri')
            ->orWhere('numero_ruc', $ruc)
            ->first();
            //->where('numero_ruc', request('search'))
        $sri = $sri ? (array) $sri : null;

        $ant = DB::connection('sqlite_ant')
            ->table('ant')
            ->where('identificacion', request('search'))
            ->get();
        //$ant = $ant ? (array) $ant : null;

        $results = [[
            'registro_civil' => $registro_civil,
            'banco' => $banco,
            'iess' => $iess,
            'sri' => $sri,
            'ant' => $ant
        ]];

        // Registrar la auditoría en la base de datos
        DB::table('auditoria_tablas_precalificacion')->insert([
            'tabla' => 'masiva',
            'parametros' => request('search'),
            'user_id' => Auth::check() ? Auth::id() : null,
            'ip_usuario' => FacadesRequest::ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Eliminar la bandera de auditoría para que no afecte otras operaciones
        Session::forget('auditoria_registrada');

        return $results;
    }

    private function descargarReportePdf($identificacion)
    {
        $pdf = Pdf::loadView('pdf.busqueda_general', [
            'general' => $this->buscar($identificacion)[0],
        ]);
        $pdf->setPaper('A4');
        $pdf->render();
        return $pdf->output();
    }
}
