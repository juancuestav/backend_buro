<?php

namespace App\Models;

use App\Models\Sistema\Notificacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class NotificacionCliente extends Model
{
    use HasFactory;
    protected $table = 'notificaciones_cliente';
    protected $fillable = [
		'mensaje',
	];

    public function notificaciones()
    {
        return $this->morphMany(Notificacion::class, 'notificable');
    }
}
