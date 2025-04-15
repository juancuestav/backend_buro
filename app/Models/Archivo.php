<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Archivo extends Model
{
	use HasFactory, Filterable;
	protected $table = 'archivos';
	protected $fillable = [
		'nombre',
		'ruta',
		'tamanio_bytes',
		'archivable_id',
		'archivable_type',
	];

	private static $whiteListFilter = ['*'];

	protected $casts = [
		'carpeta' => 'int',
	];

	// Relación polimorfica
	public function archivable()
	{
		return $this->morphTo();
	}
}
