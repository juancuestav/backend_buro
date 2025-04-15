<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{
    // Pagina Vue
    /* public function page()
	{
		return Inertia::render('pedidos/view/PedidoPage.vue');
	} */


    // Listar
    public function index(Request $request)
    {
        $results = Pedido::esPedido()->get();
        $results = $this->mapearPedidos($results);
        return response()->json(compact('results'));
        /* if ($request['tipo'] == 'todos') {
			$results = Pedido::esPedido()->get();
			$results = $this->mapearPedidos($results);
			return response()->json(compact('results'));
		}

		if ($request['tipo'] == 'abiertos') {
			$results = Pedido::where(function ($q) {
				$q->esPedido()->activo()->where('estado_pago', Pedido::PAGO_PENDIENTE);
			})->get();
			$results = $this->mapearPedidos($results);
			return response()->json(compact('results'));
		}

		if ($request['tipo'] == 'cerrados') {
			$results = Pedido::esPedido()->pagado()->orWhere('estado_pago', Pedido::ANULADO)->get();
			$results = $this->mapearPedidos($results);
			return response()->json(compact('results'));
		}

		if ($request['tipo'] == 'sin_pagar') {
			$results = Pedido::esPedido()->whereIn('estado_pago', [Pedido::ANULADO, Pedido::PAGO_PENDIENTE])->activo()->get();
			$results = $this->mapearPedidos($results);
			return response()->json(compact('results'));
		}

		if ($request['tipo'] == 'no_preparados') {
			$results = Pedido::esPedido()->activo()->get();
			$results = $this->mapearPedidos($results);
			return response()->json(compact('results'));
		}

		if ($request['tipo'] == 'cancelados') {
			$results = Pedido::esPedido()->anulado()->get();
			$results = $this->mapearPedidos($results);
			return response()->json(compact('results'));
		} */
    }

    private function mapearPedidos(Collection $listado)
    {
        return $listado->map(fn ($pedido) => [
            'id' => $pedido->id,
            'pedido' => $pedido->numero_orden,
            'fecha_emision' => $pedido->fecha_emision, // Carbon::parse($pedido->fecha_emision)->diffForHumans(),
            'cliente' => $pedido->marketings->nombre . ' ' . $pedido->marketings->apellidos ?? 'Sin cliente',
            'estado_pago' => $pedido->estado_pago,
            'metodo_pago' => $pedido->metodo_pago,
            'total' => '$' . number_format($pedido->total, 2, '.', ','),
            'tipo_pedido' => $pedido->tipo_pedido,
        ]);
    }


    // Consultar
    public function show(Pedido $pedido)
    {
        $pedido = [
            'id' => $pedido->id,
            'pedido' => '# ' . $pedido->numero_orden,
            'cliente' => $pedido->marketings,
            'fecha_emision' => $pedido->fecha_emision,
            'direccion_envio' => $pedido->direccion_envio,
            'estado_pago' => $pedido->estado_pago,
            'tipo_pedido' => $pedido->tipo_pedido,
            'precio_envio' => $pedido->precio_envio,
            'subtotal' => $pedido->subtotal,
            'total' => $pedido->total,
            'pago_cliente' => $pedido->pago_cliente,
            'metodo_pago' => $pedido->metodo_pago,
            'reembolsado' => $pedido->reembolsado,
            'iva' => $pedido->iva,
            'comentario' => $pedido->comentario,
            'servicio' => $pedido->servicios->nombre,
            'tiene_reporte' => $pedido->tiene_reporte,
            'conoce_puntaje' => $pedido->conoce_puntaje,
            'tiene_deudas' => $pedido->tiene_deudas,
            'es_cliente' => $pedido->es_cliente,
            'deposito_transferencia' => $pedido->depositos_transferencias?->id,
            'lineas_pedido' => $pedido->lineas_pedido->map(fn ($linea) => [
                'id' => $linea->id,
                'cantidad' => $linea->cantidad,
                'cantidad_preparada' => $linea->cantidad_preparada,
                'cantidad_devuelta' => $linea->cantidad_devuelta,
                'precio' => $linea->precio,
                'pedido' => $linea->pedido,
                'servicio' => $linea->servicios?->nombre,
            ])->toArray(),
        ];
        return response()->json(['modelo' => $pedido]);
    }

    // public function registrarPagoEfectivo(Request $request)
    public function update(Request $request, Pedido $pedido)
    {
        // $pedido = Pedido::find($request['pedido']);
        $pedido->estado_pago = Pedido::PAGADO;
        $pedido->pago_cliente = $pedido->total;
        $pedido->save();

        return response()->json(['mensaje' => 'Pago registrado exitosamente!', 'modelo' => $pedido]);
    }


    /* public function anular(Request $request)
	{
		$pedido = Pedido::find($request['pedido']);
		$pedido->estado_pago = Pedido::ANULADO;
		$pedido->subtotal = 0;
		$pedido->total = 0;
		$pedido->iva = 0;
		$pedido->save();
		return response()->json(['mensaje' => 'El pedido ha sido anulado exitosamente!']);
	} */

    private function calcularIvaPedido(Pedido $pedido)
    {
        $iva = 0;
        foreach ($pedido->lineas_pedido as $linea_pedido) {
            $iva += $linea_pedido->cantidad * $linea_pedido->variantes->iva;
        }
        return $iva;
    }


    // Eliminar
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return response()->json(['mensaje' => 'El pedido se ha eliminado exitosamente!']);
    }

    // Verificar si el id es de pedido o carrito
    public function downloadPdf(Request $request, Pedido $pedido)
    {
        if ($pedido->fecha_emision != null) {

            view()->share('pdf.pedido', $pedido);

            $pdf = Pdf::loadView('pdf.pedido', ['pedido' => $pedido]);

            return $pdf->download('pedido.pdf');
        }

        return response()->json(['mensaje' => 'No puede acceder a este recurso.']);
    }
}
