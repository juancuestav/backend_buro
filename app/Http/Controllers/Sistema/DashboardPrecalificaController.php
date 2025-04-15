<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPrecalificaController extends Controller
{
    public function index()
    {
        $results = DB::table('auditoria_tablas_precalificacion')->where('user_id', request('user_id'))->get()->map(function ($auditoria) {
            $auditoria->usuario = User::extraerNombresApellidos(User::find($auditoria->user_id));
            $auditoria->tipo = strlen($auditoria->parametros) == '13' ? 'RUC' : 'CEDULA';
            return $auditoria;
        });

        return response()->json(compact('results'));
    }

    public function usuariosDashboardPrecalifica()
    {
        // Realizar la consulta que cuenta el total de consultas por usuario
        $usuariosConsultas = DB::table('auditoria_tablas_precalificacion')
            ->select('user_id', DB::raw('COUNT(*) as total_consultas'))
            ->groupBy('user_id')
            ->orderByDesc('total_consultas') // Opcional: ordenar por cantidad de consultas (de mayor a menor)
            ->get();

        // Opcional: Si deseas incluir los nombres o detalles de los usuarios, puedes hacer un join con la tabla users
        $usuariosConDetalles = DB::table('auditoria_tablas_precalificacion')
            ->join('users', 'auditoria_tablas_precalificacion.user_id', '=', 'users.id')
            ->select(
                'users.id',
                DB::raw('CONCAT(users.name, " ", users.apellidos) as usuario'),
                'users.email',
                DB::raw('COUNT(*) as total_consultas')
            )
            ->groupBy('auditoria_tablas_precalificacion.user_id', 'users.id', 'users.name', 'users.apellidos', 'users.email')
            ->orderByDesc('total_consultas')
            ->get();


        return response()->json([
            'results' => $usuariosConDetalles // o usar $usuariosConsultas si solo necesitas el ID y la cantidad
        ]);
    }
}
