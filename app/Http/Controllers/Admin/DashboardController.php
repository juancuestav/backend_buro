<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacturacionPlan;
use App\Models\Pedido;
use App\Models\Reporte;
use App\Models\Servicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.ver.tablero')->only('index');
        // $this->middleware('verified');
    }

    public function index()
    {
        $usuariosVerificados = User::where('email_verified_at', '!=', null)->count();
        $usuariosNoVerificados = User::where('email_verified_at', null)->count();
        $serviciosActivos = Servicio::activo()->esServicio()->get()->count();
        $planesActivos = Servicio::activo()->esPlan()->get()->count();
        $pedidos = Pedido::where('fecha_emision', '!=', null)->count();
        $usuariosConectados = User::where('conectado', true)->count();
        $usuariosConectadosDia = User::where('hora_conexion', '<=', Carbon::now())->where('hora_conexion', '>=', Carbon::today())->count();
        $usuariosConectadosMes = User::where('hora_conexion', '<=', Carbon::now())->where('hora_conexion', '>=', Carbon::parse($this->getInicioMes()))->count();
        $usuarioConPlanesPagados = FacturacionPlan::where('pagado', true)->count();
        $usuarioConPlanesNoPagados = FacturacionPlan::where('pagado', false)->count();
        $reportes = Reporte::count();

        $archivo = 'contador_payphone.txt';
        $f = fopen($archivo, 'r');
        $clicks_payphone = 0;
        if ($f) {
            $clicks_payphone = intval(fread($f, filesize($archivo)));
            fclose($f);
        }

        
        $modelo = compact(
            'usuariosVerificados',
            'usuariosNoVerificados',
            'serviciosActivos',
            'planesActivos',
            'pedidos',
            'usuariosConectados',
            'usuariosConectadosDia',
            'usuariosConectadosMes',
            'usuarioConPlanesPagados',
            'usuarioConPlanesNoPagados',
            'reportes',
            'clicks_payphone'
        );

        return response()->json(compact('modelo'));
        // return Inertia::render('dashboard/view/DashboardPage.vue', compact('usuarios', 'serviciosActivos', 'planesActivos', 'pedidos', 'usuariosConectados', 'usuariosConectadosDia', 'usuariosConectadosMes', 'usuarioConPlanesPagados', 'usuarioConPlanesNoPagados'));
    }

    private function getInicioMes()
    {
        $dt = Carbon::now();

        $fecha = $dt->year . '-' . $dt->month . '-1 ' . '00:00:00';
        // Log::channel('testing')->info('Log', ['servicios logout', $fecha]);
        return $fecha;
    }
}
