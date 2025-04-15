<?php

namespace Database\Seeders;

use App\Models\TipoIdentificacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIdentificacionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		TipoIdentificacion::create(['descripcion' => User::CEDULA]);
		TipoIdentificacion::create(['descripcion' => User::RUC]);
		TipoIdentificacion::create(['descripcion' => User::PASAPORTE]);
	}
}
