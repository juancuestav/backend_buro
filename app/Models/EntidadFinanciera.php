<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadFinanciera extends Model
{
    use HasFactory;

	protected $table = 'entidades_financieras';

	const BANCO = 'BANCO';
	const COOPERATIVA = 'COOPERATIVA';
	const CAJA_DE_AHORRO = 'CAJA DE AHORRO';

	protected $hidden = [
		'created_at',
		'updated_at',
	];

	protected $fillable = [
		'nombre',
		'tipo',
	];
}
