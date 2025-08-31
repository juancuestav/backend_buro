<?php

namespace Database\Seeders\Trabajos;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Src\Config\Permisos;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class="Database\Seeders\Trabajos\PermisosSeeder"
     * @return void
     */
    public function run()
    {
        $administrador = Role::firstOrCreate(['name' => User::ROL_ADMINISTRADOR]);
        $cliente = Role::firstOrCreate(['name' => User::ROL_CLIENTE]);
        $empleado = Role::firstOrCreate(['name' => User::ROL_EMPLEADO]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'verifica_cuenta'])->syncRoles([$cliente]);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'aprobar_verificar_cuenta'])->syncRoles([$cliente]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'usuarios'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'usuarios'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'usuarios'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'usuarios'])->syncRoles([$administrador]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'ofertas_disponibles'])->syncRoles([$cliente]);

        // Super administrador
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'roles']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'permisos']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'permisos_roles']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'permisos_usuarios']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'configuraciones_generales']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'modulo_administracion']);
    }
}
