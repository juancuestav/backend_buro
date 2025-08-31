<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
	use HasFactory;

	protected $table = 'servicios';
	protected $casts = ['gravable' => 'bool', 'es_plan' => 'bool', 'categoria' => 'int'];
	protected $fillable = [
		'nombre',
		'descripcion',
		'estado',
		'categoria',
		'precio_unitario',
		'gravable',
		'tipo_servicio',
		'iva',
		'url_video',
		'url_destino', // <- payphone
		'url_paypal',
	];

	const ACTIVO = 'ACTIVO';
	const BORRADOR = 'BORRADOR';

	// Relacion uno a uno polimorfica
	public function images()
	{
		return $this->morphOne(Image::class, 'imageable');
	}

	public function scopeActivo($query)
	{
		return $query->where('estado', Servicio::ACTIVO);
	}

	public function scopeEsPlan($query)
	{
		return $query->where('tipo_servicio', 'PLAN');
	}

	public function scopeEsServicio($query)
	{
		return $query->where('tipo_servicio', 'SERVICIO');
	}

	public function scopeEsSolucionesEmpresas($query)
	{
		return $query->where('tipo_servicio', 'SOLUCIONES EMPRESAS');
	}

	public function categorias()
	{
		return $this->belongsTo(Categoria::class, 'categoria', 'id');
	}
}
