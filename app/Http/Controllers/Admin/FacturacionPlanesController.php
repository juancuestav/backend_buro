<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\FacturacionPlanResource;
use App\Models\FacturacionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Src\App\Sistema\PaginationService;

/**
 * Todo usuario registrado en el sistema tiene un registro en la tabla de facturacion de manera automática
 */
class FacturacionPlanesController extends Controller
{
    protected PaginationService $paginationService;

    public function __construct()
    {
        /* $this->middleware('can:puede.ver.servicios')->only('listar');
        $this->middleware('can:puede.ver.servicios')->only('index');
        $this->middleware('can:puede.ver.servicios')->only('page'); */
        $this->paginationService = new PaginationService();
    }


    // Pagina Vue
    /* public function index(Request $request)
    {
        $pagado = $request['pagado'];

        if (!isset($pagado)) {
            $results = FacturacionPlanResource::collection(FacturacionPlan::all());
        } else {
            $results = FacturacionPlanResource::collection(FacturacionPlan::where('pagado', ($pagado === 'true'))->get())->all();
        }


        $facturaciones = FacturacionPlan::where('proximo_pago', Carbon::now()->format('Y-m-d'))->get();
        // Log::channel('testing')->info('Log', ['listado', Carbon::now()->format('Y-m-d')]);
        foreach ($facturaciones as $facturacion_plan) {
            $this->verificarFechaFacturacion($facturacion_plan);
        }

        // return Inertia::render('facturacionPlanes/view/FacturacionPlanesPage.vue', compact('facturacion_planes'));
        return response()->json(compact('results'));
    } */
    public function index()
    {
        $search = request('search');
        $paginate = request('paginate');

        if ($search) {
            $query = FacturacionPlan::whereHas('usuarios', function ($query) use ($search) {
                $query->where('identificacion', 'like', '%' . $search . '%');
            });
        } else {
            $query = FacturacionPlan::ignoreRequest(['campos', 'page', 'paginate'])->filter()->orderBy('id', 'desc');
        }

        if ($paginate) $results = $this->paginationService->paginate($query, 100, request('page'));
        else $results = $query->get();

        return FacturacionPlanResource::collection($results);
    }

    // Si el usuario envia captura del pago, el administrador cambia el estado a Pagado
    public function update(Request $request, $facturacion_plan)
    {
        $entidad = FacturacionPlan::find($facturacion_plan);
        $entidad->pagado = true;
        $entidad->fecha_pago = date('Y-m-d');
        $entidad->proximo_pago = Carbon::now()->addMonth()->toDateString();

        $entidad->save();
        return response()->json(['mensaje' => 'Estado de pago actualizado exitosamente!']);
    }

    // El administrador también puede cambiar el estado a No pagado
    public function destroy($facturacion_plan)
    {
        $entidad = FacturacionPlan::find($facturacion_plan);
        $entidad->pagado = false;
        $entidad->save();
        return response()->json(['mensaje' => 'Estado de pago actualizado exitosamente!']);
    }

    private function verificarFechaFacturacion(FacturacionPlan $facturacion_plan)
    {
        // if ($facturacion_plan->fecha_pago == date("c")) {
        $facturacion_plan->pagado = false;
        $facturacion_plan->save();
        // }
    }
}
