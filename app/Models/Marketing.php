<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    use HasFactory;
	protected $guarded = ['id'];

    public function provincias() {
        return $this->belongsTo(Provincia::class, 'provincia');
    }

    public function ciudades() {
        return $this->belongsTo(Ciudad::class, 'ciudad');
    }

    public function tipos_identificaciones() {
        return $this->belongsTo(TipoIdentificacion::class, 'tipo_identificacion');
    }
}
