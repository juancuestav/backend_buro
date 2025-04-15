<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provincia::insert([
			['id' => 1,  'descripcion' => 'AZUAY'],
			['id' => 2,  'descripcion' => 'BOLÍVAR'],
			['id' => 3,  'descripcion' => 'CAÑAR'],
			['id' => 4,  'descripcion' => 'CARCHI'],
			['id' => 5,  'descripcion' => 'COTOPAXI'],
			['id' => 6,  'descripcion' => 'CHIMBORAZO'],
			['id' => 7,  'descripcion' => 'EL ORO'],
			['id' => 8,  'descripcion' => 'ESMERALDAS'],
			['id' => 9,  'descripcion' => 'GUAYAS'],
			['id' => 10, 'descripcion' => 'IMBABURA'],
			['id' => 11, 'descripcion' => 'LOJA'],
			['id' => 12, 'descripcion' => 'LOS RÍOS'],
			['id' => 13, 'descripcion' => 'MANABÍ'],
			['id' => 14, 'descripcion' => 'MORONA SANTIAGO'],
			['id' => 15, 'descripcion' => 'NAPO'],
			['id' => 16, 'descripcion' => 'PASTAZA'],
			['id' => 17, 'descripcion' => 'PICHINCHA'],
			['id' => 18, 'descripcion' => 'TUNGURAHUA'],
			['id' => 19, 'descripcion' => 'ZAMORA CHINCHIPE'],
			['id' => 20, 'descripcion' => 'GALÁPAGOS'],
			['id' => 21, 'descripcion' => 'SUCUMBÍOS'],
			['id' => 22, 'descripcion' => 'ORELLANA'],
			['id' => 23, 'descripcion' => 'SANTO DOMINGO DE LOS TSÁCHILAS'],
			['id' => 24, 'descripcion' => 'SANTA ELENA'],
		]);
    }
}
