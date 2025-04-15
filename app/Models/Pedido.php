<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
	use HasFactory;

	protected $table = 'pedidos';

	// estado_pago
	const PAGO_PENDIENTE = 'PAGO PENDIENTE';
	const PAGADO = 'PAGADO';
	const ANULADO = 'ANULADO';

	// estado devolucion
	const DEVUELTO = 'DEVUELTO';
	const EN_CURSO = 'DEVOLUCION EN CURSO';

	// metodo_pago
	const EFECTIVO = 'EFECTIVO';
	const DEPOSITO = 'DEPOSITO';
	const TARJETA = 'TARJETA';

	// tipo pedido
	const DOMICILIO = 'DOMICILIO';
	const RETIRAR = 'RETIRAR';
	const SERVICIO = 'SERVICIO';

	public function lineas_pedido()
	{
		return $this->hasMany(LineaPedido::class, 'pedido');
	}

	// Relacion de uno a muchos (inversa)
	public function marketings()
	{
		return $this->belongsTo(Marketing::class, 'marketing');
	}

	// Relacion de uno a muchos (inversa)
	public function servicios()
	{
		return $this->belongsTo(Servicio::class, 'servicio');
	}

	// Relacion de uno a uno
	public function depositos_transferencias()
	{
		return $this->hasOne(DepositoTransferencia::class, 'pedido');
	}

	public function obtenerSubtotal()
	{
		return $this->hasMany(LineaPedido::class, 'pedido')->sum('precio');
	}

	/**
	 * Scopes
	 */

	// Si no es pedido entonces es carrito
	public function scopeEsPedido($query)
	{
		return $query->where('fecha_emision', '!=', null);
	}

	public function scopePagado($query)
	{
		return $query->where('estado_pago', Pedido::PAGADO);
	}

	public function scopeAnulado($query)
	{
		return $query->where('estado_pago', Pedido::ANULADO);
	}

	public function scopeActivo($query)
	{
		return $query->where('estado_pago', '!=', Pedido::ANULADO);
	}
}
