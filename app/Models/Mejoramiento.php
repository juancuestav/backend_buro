<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mejoramiento extends Model
{
    use HasFactory;
    protected $table = 'mejoramientos';
    protected $guarded = [
        'id',
    ];

    // Estados de la solicitud
    const PENDIENTE = 'PENDIENTE';
    const EN_PROCESO = 'EN PROCESO';
    const APROBADO = 'APROBADO';
    const NEGADO = 'NEGADO';

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario');
    }
}
