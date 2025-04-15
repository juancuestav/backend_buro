<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $table = 'scores';
    protected $guarded = ['id'];

    // Relacion de uno a muchos (inversa)
    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario');
    }
}
