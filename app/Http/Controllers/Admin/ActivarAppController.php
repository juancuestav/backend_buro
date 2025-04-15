<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServicioResource;
use App\Models\FacturacionPlan;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class ActivarAppController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:puede.ver.activar_app')->only(['page']);
    }

    public function index()
    {
        $facturacion = FacturacionPlan::where('usuario', Auth::id())->first();
        $fecha_proximo_pago = $facturacion?->proximo_pago;
        $pagado = $facturacion?->pagado;
        $planes = ServicioResource::collection(Servicio::activo()->esPlan()->get())->all();
        // $celular = Config::get('buro.whatsapp');

        /* if($facturacion) {
            $this->verificarFechaFacturacion($facturacion);
        } */
        // return Inertia::render('activarApp/view/ActivarAppPage.vue', compact('planes', 'facturacion', 'celular'));
        return response()->json(compact('planes', 'fecha_proximo_pago', 'pagado'));
    }

    public function pagado() {
        $facturacion = FacturacionPlan::where('usuario', Auth::id())->first();
        $pagado = $facturacion?->pagado;
        return response()->json(compact('pagado'));
    }
}
