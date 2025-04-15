<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaPedido extends Model
{
	use HasFactory;

	protected $table = 'lineas_pedido';

	// Relacion de uno a muchos (inversa)
	public function pedidos()
	{
		return $this->belongsTo(Pedido::class, 'pedido');
	}

	// Relacion de uno a muchos (inversa)
	public function servicios()
	{
		return $this->belongsTo(Servicio::class, 'servicio');
	}
}
