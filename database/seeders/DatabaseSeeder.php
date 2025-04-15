<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(TipoIdentificacionSeeder::class);
		$this->call(RoleSeeder::class);
		// $this->call(CarpetaSeeder::class);
		$this->call(ProvinciaSeeder::class);
		$this->call(CiudadSeeder::class);
		$this->call(UserSeeder::class);

		// \App\Models\User::factory(10)->create();

		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);
	}
}
