<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Carpeta extends Model
{
	use HasFactory;
	protected $table = 'carpetas';
	protected $fillable = [
		'nombre',
		'id_carpeta_padre',
		'usuario',
	];

	protected $casts = [
		'id_carpeta_padre' => 'int',
		'usuario' => 'int',
	];

	// Relacion de uno a muchos
	public function archivos()
	{
		return $this->hasMany(Archivo::class, 'carpeta');
	}

	// Relacion de uno a muchos
	public function subcarpetas()
	{
		return $this->hasMany(Carpeta::class, 'id_carpeta_padre');
	}

	// Relacion de uno a uno (inversa)
	public function usuarios()
	{
		return $this->belongsTo(User::class, 'usuario');
	}


	/**
	 * Scopes
	 */
	public function scopeRaiz($query)
	{
		return $query->where('id_carpeta_padre', null);
	}

	public function scopeUsuarioActual($query)
	{
		return $query->where('usuario', Auth::id());
	}
}
