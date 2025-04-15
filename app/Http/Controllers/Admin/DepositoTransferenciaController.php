<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepositoTransferencia;
use App\Models\EntidadFinanciera;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Src\App\DepositosTransferencias\GuardarImagenDepositoTransferencia;

class DepositoTransferenciaController extends Controller
{
	private $entidades_financieras;

	public function __construct()
	{
		// $this->middleware('can:puede.ver.depositos-transferencias')->only(['index', 'show', 'edit', 'page']);
		// $this->middleware('can:puede.crear.depositos-transferencias')->only(['store', 'create']);

		// Listados
		$this->entidades_financieras = EntidadFinanciera::all()->map(fn ($entidad) => [
			'id' => $entidad->id,
			'descripcion' => $entidad->nombre,
		]);
	}


	/**
	 * Pagina Vue
	 */
	public function page()
	{
		$entidades_financieras = $this->entidades_financieras;
		return Inertia::render('depositosTransferencias/view/DepositoTransferenciaPage.vue', compact('entidades_financieras'));
	}


	/**
	 * Pagina Vue
	 * Pedido
	 * Formulario para crear un deposito o transferencia para un pedido
	 */
	public function create(Request $request)
	{
		$request->validate(['pedido' => 'required']);

		$pedido_encontrado = Pedido::find($request['pedido']);
		$depositos_transferencia = $pedido_encontrado->depositos_transferencias;

		$modelo = [
			'monto' => $pedido_encontrado->total,
			'pedido' => $pedido_encontrado->id,
			'fecha_transaccion' => $pedido_encontrado->fecha_emision,
		];

		$entidades_financieras = $this->entidades_financieras;

		return Inertia::render('pedidos/modules/depositosTransferencias/view/DepositoTransferenciaPage.vue', compact('modelo', 'entidades_financieras'));
	}


	/**
	 * Pagina Vue
	 * Pedido
	 * Formulario para consultar un deposito o transferencia creado por un pedido
	 */
	public function edit(Request $request, DepositoTransferencia $depositos_transferencia)
	{
		$modelo = $depositos_transferencia;
		$pedido = intval($depositos_transferencia->pedido);

		$modelo = [
			'id' => $depositos_transferencia->id,
			'cuenta' => $depositos_transferencia->cuenta,
			'motivo' => $depositos_transferencia->motivo,
			'es_deposito' => $depositos_transferencia->es_deposito,
			'monto' => $depositos_transferencia->monto,
			'comprobante' => $depositos_transferencia->comprobante,
			'pedido' => $pedido,
			'fecha_transaccion' => $depositos_transferencia->fecha_transaccion,
			'tipo_transferencia' => $depositos_transferencia->tipo_transferencia,
			'imagen' => str_replace('storage', 'admin', $depositos_transferencia->images?->url),
		];

		$entidades_financieras = EntidadFinanciera::all()->map(fn ($entidad) => [
			'id' => $entidad->id,
			'descripcion' => $entidad->nombre,
		]);

		return Inertia::render('pedidos/modules/depositosTransferencias/view/DepositoTransferenciaPage.vue', compact('modelo', 'pedido', 'entidades_financieras'));
	}


	/**
	 * Pedido
	 * Guardar un deposito o transferencia para un pedido 
	 */
	public function store(Request $request)
	{
		$validador = Validator::make($request->all(), [
			'pedido' => 'required|numeric|integer',
			'cuenta' => 'required|numeric|integer',
			'motivo' => 'required|string',
			'es_deposito' => 'required|boolean',
			'monto' => 'required|numeric',
			'comprobante' => 'required|string',
			'fecha_transaccion' => 'required|date',
			'tipo_transferencia' => 'nullable|string',
			'imagen' => 'required|string',
		]);

		$pedido = Pedido::find($request['pedido']);
		$fecha_actual = date("Y-m-d");
		$fecha_pedido = $pedido->fecha_emision;
		$total = $pedido->total;

		if ($request['fecha_transaccion'] < $fecha_pedido) {
			return response()->json(['mensaje' => 'La fecha no puede ser menor a la fecha del pedido.'], 422);
		}

		if ($request['fecha_transaccion'] > $fecha_actual) {
			return response()->json(['mensaje' => 'La fecha no puede ser mayor a la fecha actual.'], 422);
		}

		if (floatval($request['monto']) != $total) {
			return response()->json(['mensaje' => 'El monto debe ser igual al total del pedido.'], 422);
		}

		if ($pedido) {
			DB::transaction(function () use ($pedido, $validador, $request) {
				$deposito_transferencia = DepositoTransferencia::create($validador->validated());

				$guardar_imagen = new GuardarImagenDepositoTransferencia($deposito_transferencia, $request['imagen']);
				$guardar_imagen->execute();

				$this->registrarPago($pedido);
			});
			return response()->json(['mensaje' => 'Pago guardado exitosamente!']);
		}
		return response()->json(['mensaje' => 'El pedido no existe!'], 422);
	}

	private function registrarPago(Pedido $pedido)
	{
		$pedido->estado_pago = Pedido::PAGADO;
		$pedido->pago_cliente = $pedido->total;
		$pedido->save();
	}


	// Consultar
	public function show(Request $request, DepositoTransferencia $depositos_transferencia)
	{
		$modelo = $depositos_transferencia;
		$pedido = intval($depositos_transferencia->pedido);

		$modelo = [
			'id' => $depositos_transferencia->id,
			'cuenta' => $depositos_transferencia->cuenta,
			'motivo' => $depositos_transferencia->motivo,
			'es_deposito' => $depositos_transferencia->es_deposito,
			'monto' => $depositos_transferencia->monto,
			'comprobante' => $depositos_transferencia->comprobante,
			'fecha_transaccion' => $depositos_transferencia->fecha_transaccion,
			'tipo_transferencia' => $depositos_transferencia->tipo_transferencia,
			'imagen' => str_replace('storage', 'admin', $depositos_transferencia->images?->url),
		];

		return response()->json(compact('modelo'));
	}


	// Listar
	public function index(Request $request)
	{
		$results = DepositoTransferencia::all()->map(fn ($item) => [
			'id' => $item->id,
			'fecha' => $item->fecha_transaccion,
			'comprobante' => $item->comprobante,
			'tipo' => $item->es_deposito ? DepositoTransferencia::DEPOSITO : $item->tipo_transferencia,
			'motivo' => $item->motivo,
			'cuenta' => $item->cuenta,
			'monto' => '$ ' . number_format($item->monto, 2, '.', ','),
		]);
		return response()->json(compact('results'));
	}
}
