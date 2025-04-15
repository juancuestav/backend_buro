<?php

namespace App\Models\Reporte;

use App\Models\Archivo;
use App\Models\Sistema\Notificacion;
use App\Traits\SubirArchivoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

/**
 * @method static create(mixed $datos)
 */
class ArchivoReporte extends Model
{
	use HasFactory, Filterable, SubirArchivoTrait;
	protected $table = 'rep_archivo_reportes';
	protected $fillable = [
		'titulo',
		'user_id',
		'subido_por_user_id',
		'reporte_id',
	];

	private static $whiteListFilter = ['*'];

	public function archivos()
	{
		return $this->morphMany(Archivo::class, 'archivable');
	}

    public function notificaciones()
    {
        return $this->morphMany(Notificacion::class, 'notificable');
    }
}
