<?php

namespace App\Models;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory, Filterable;

    protected $table = 'ciudades';

	protected $casts = [
		'provincia' => 'int',
	];

	private static $whiteListFilter = ['*'];
}
