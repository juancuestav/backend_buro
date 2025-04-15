<?php

namespace Database\Seeders;

use App\Models\FacturacionPlan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrador
        $user = User::create([
            'name' => 'SEBASTIAN',
            'apellidos' => null,
            'celular' => '0897654321',
            'identificacion' => '0749632157',
            'tipo_identificacion' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => date("Y-m-d"),
            'password' => bcrypt('password'),
            'direccion' => 'Direccion 1',
        ])->assignRole(User::ROL_EMPLEADO);
        // 'fecha_nacimiento' => '18/05/1994',
        $facturacion = new FacturacionPlan();
        $facturacion->usuario = $user->id;
        $facturacion->save();

        // Cliente
        $user_cliente = User::create([
            'name' => 'USUARIO',
            'apellidos' => 'PRUEBA',
            'celular' => '0897654322',
            'identificacion' => '0849632158',
            'tipo_identificacion' => 1,
            'email' => 'prueba@prueba.com',
            'email_verified_at' => date("Y-m-d"),
            'password' => bcrypt('password'),
            'direccion' => 'Direccion 2',
        ]);

        $user_cliente->assignRole(User::ROL_CLIENTE);

        $facturacion = new FacturacionPlan();
        $facturacion->usuario = $user_cliente->id;
        $facturacion->save();
        // 'fecha_nacimiento' => '24/06/1995',
    }
}
