<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MiPedidoController extends Controller
{
	public function __construct()
	{
		/* $this->middleware('can:puede.ver.mis_pedidos')->only('listar');
		$this->middleware('can:puede.ver.mis_pedidos')->only('index');
		$this->middleware('can:puede.anular.mis_pedidos')->only('anular'); */
	}


	// Pagina Vue
	public function page()
	{
		return Inertia::render('misPedidos/view/MiPedidoPage.vue');
	}


	// Listar
	public function index(Request $request)
	{
		$results = Pedido::where('fecha_emision', '!=', null)->where('usuario', Auth::id())->get()->map(fn ($pedido) => [
			'id' => $pedido->id,
			'pedido' => $pedido->numero_orden,
			'fecha_emision' => $pedido->fecha_emision, //Carbon::parse($pedido->fecha_emision)->diffForHumans(),
			'cliente' => $pedido->usuarios->name . ' ' . $pedido->usuarios->apellidos ?? 'Sin cliente',
			'estado_pago' => $pedido->estado_pago,
			'metodo_pago' => $pedido->metodo_pago,
			'total' => '$' . number_format($pedido->total, 2, '.', ','),
			'tipo_pedido' => $pedido->tipo_pedido,
		]);
		return response()->json(compact('results'));
	}


	public function anular(Request $request)
	{
		$request->validate(['pedido' => 'required|numeric|integer']);

		$pedido = Pedido::find($request['pedido']);

		if ($pedido->usuario != Auth::id()) {
			return response()->json(['mensaje' => 'No eres propietario de éste pedido!'], 409);
		}

		if ($pedido->estado_pago == Pedido::ANULADO) {
			return response()->json(['mensaje' => 'Éste pedido ya fue anulado!'], 409);
		}

		if ($pedido->estado_pago == Pedido::PAGADO) {
			return response()->json(['mensaje' => 'Éste pedido ya se completó y no puede ser anulado!'], 409);
		}

		$pedido->estado_pago = Pedido::ANULADO;
		$pedido->subtotal = 0;
		$pedido->total = 0;
		$pedido->iva = 0;
		$pedido->save();

		return response()->json(['mensaje' => 'El pedido ha sido anulado exitosamente!']);
	}
}
