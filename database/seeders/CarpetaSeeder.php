<?php

namespace Database\Seeders;

use App\Models\Carpeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarpetaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Carpeta::insert([
			['id' => 1, 'nombre' => 'Karla Cueva', 'id_carpeta_padre' => null, 'usuario' => 1],
			['id' => 2, 'nombre' => 'Gabriela Astudillo', 'id_carpeta_padre' => null, 'usuario' => null],
			['id' => 3, 'nombre' => 'Fernando Duarte', 'id_carpeta_padre' => null, 'usuario' => null],
			['id' => 4, 'nombre' => 'Informes Karla', 'id_carpeta_padre' => 1, 'usuario' => null],
			['id' => 5, 'nombre' => 'Anexos Karla', 'id_carpeta_padre' => 1, 'usuario' => null],
			['id' => 6, 'nombre' => 'Informes Gabriela', 'id_carpeta_padre' => 2, 'usuario' => null],
			['id' => 7, 'nombre' => 'Informes Fernando', 'id_carpeta_padre' => 3, 'usuario' => null],
		]);
	}
}
