<?php

namespace App\Models;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableModel;

class FacturacionPlan extends Model implements Auditable
{
    use HasFactory, Searchable, Filterable, AuditableModel;
    protected $table = 'facturacion_planes';
    protected $casts = ['pagado' => 'boolean'];
    public $timestamps = false;

    private static $whiteListFilter = ['*'];

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'usuario');
    }
}
