<?php

namespace App\Models\Usuario;

use App\Models\User;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificarCuenta extends Model
{
    use HasFactory, Filterable;

    protected $table = 'usu_verificar_cuentas';
    private static $whiteListFilter = ['*'];
    protected $fillable = [
        'documento_identidad_anverso',
        'documento_identidad_reverso',
        'documento_identidad_selfie',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
