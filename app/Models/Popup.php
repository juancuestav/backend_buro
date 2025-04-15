<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
	use HasFactory;

	protected $table = 'popups';
	protected $guarded = ['id'];
	public $timestamps = false;
	protected $casts = [
		'nueva_pestana' => 'bool',
	];

	// Relacion uno a uno polimorfica
	public function images()
	{
		return $this->morphOne(Image::class, 'imageable');
	}
}
