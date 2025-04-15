<?php

namespace App\Models\Admin;

use App\Models\Ciudad;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'admin_user_profiles';

    protected $fillable = [
        'puntuacion',
        'tipo_cliente',
        'provincia_id',
        'canton_id',
        'user_id',
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function canton()
    {
        return $this->belongsTo(Ciudad::class); //, 'canton_id', 'id');
    }
}
