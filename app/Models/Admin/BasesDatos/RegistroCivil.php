<?php

namespace App\Models\Admin\BasesDatos;

use App\Models\Admin\CondicionCivil;
use App\Models\Admin\EstadoCivil;
use App\Models\Admin\InstruccionCivil;
use App\Models\Admin\RegistroCivilInstruccion;
use App\Models\Admin\RegistroCivilPais;
use App\Models\Admin\Sexo;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCivil extends Model
{
    use HasFactory, Filterable;

    protected $table = 'admin_registro_civil';

    private static $whiteListFilter = ['*'];

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'sexo_id');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil_id');
    }

    public function condicion()
    {
        return $this->belongsTo(CondicionCivil::class, 'condicion_id');
    }

    public function pais()
    {
        return $this->belongsTo(RegistroCivilPais::class, 'pais_id');
    }

    public function instruccion()
    {
        return $this->belongsTo(RegistroCivilInstruccion::class, 'instruccion_id');
    }
}
