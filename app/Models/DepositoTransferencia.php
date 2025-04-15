<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositoTransferencia extends Model
{
    use HasFactory;

	protected $table = 'depositos_transferencias';
	protected $guarded = ['id'];

	protected $casts = [
		'es_deposito' => 'boolean',
	];

	const DEPOSITO = 'DEPOSITO';
	
	// Tipos de transferencias
	const TRASPASO = 'TRASPASO';
	const TRANSFERENCIA = 'TRANSFERENCIA';

	// Relacion de uno a muchos (inversa)
	public function entidades_financieras()
	{
		return $this->belongsTo(EntidadFinanciera::class, 'cuenta');
	}

	// Relacion uno a uno polimorfica
	public function images()
	{
		return $this->morphOne(Image::class, 'imageable');
	}
}
