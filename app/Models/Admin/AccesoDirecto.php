<?php

namespace App\Models\Admin;

use App\Models\Archivo;
use App\Traits\SubirArchivoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Auditable as AuditableModel;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static create(mixed $datos)
 */
class AccesoDirecto extends Model implements Auditable
{
    use HasFactory, AuditableModel, Searchable, SubirArchivoTrait;

    protected $table = 'admin_accesos_directos';
    protected $fillable = [
        'titulo',
        'link',
        'descripcion',
        'imagen',
        'nueva_pestana',
    ];

    protected $casts = [
        'nueva_pestana' => 'boolean',
    ];

    public function toSearchableArray()
    {
        return [
            'titulo' => $this['titulo'],
        ];
    }

    public function archivos()
    {
        return $this->morphMany(Archivo::class, 'archivable');
    }
}
