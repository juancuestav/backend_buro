<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => User::ROL_ADMINISTRADOR]);
        $cliente = Role::firstOrCreate(['name' => User::ROL_CLIENTE]);
        $empleado = Role::firstOrCreate(['name' => User::ROL_EMPLEADO]);

        // -----------------
        // Modulo de Sistema
        // -----------------
        // Tablero
        Permission::firstOrCreate(['name' => 'puede.ver.tablero'])->assignRole($empleado);

        // Permission::firstOrCreate(['name' => 'puede.ver.dashboard'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => 'puede.recibir.notificaciones'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.ver.notificaciones'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.ver.consultar'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.ver.perfil'])->assignRole($empleado);

        // Gestor de archivos
        Permission::firstOrCreate(['name' => 'puede.gestionar.recursos'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.descargar.recursos'])->syncRoles([$empleado, $cliente]);
        Permission::firstOrCreate(['name' => 'puede.ver.gestor_archivos'])->assignRole($empleado);


        Permission::firstOrCreate(['name' => 'puede.ver.servicios'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.servicios'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.servicios'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.servicios'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.reportes'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.reportes'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.reportes'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.reportes'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.categorias'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.categorias'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.categorias'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.categorias'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.pedidos'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.pedidos'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.pedidos'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.pedidos'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.mis_pedidos'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.anular.mis_pedidos'])->assignRole($cliente);

        Permission::firstOrCreate(['name' => 'puede.ver.roles_permisos'])->assignRole($empleado);
		Permission::firstOrCreate(['name' => 'puede.crear.roles_permisos'])->assignRole($empleado);
		Permission::firstOrCreate(['name' => 'puede.editar.roles_permisos'])->assignRole($empleado);
		Permission::firstOrCreate(['name' => 'puede.eliminar.roles_permisos	'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.usuarios'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.usuarios'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.usuarios'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.usuarios'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.popup'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.popup'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.popup'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.popup'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.consultar_reportes'])->assignRole($empleado);
        // Permission::firstOrCreate(['name' => 'puede.crear.consultar_reportes'])->assignRole($empleado);
        // Permission::firstOrCreate(['name' => 'puede.editar.reportes'])->assignRole($empleado);
        // Permission::firstOrCreate(['name' => 'puede.eliminar.reportes'])->assignRole($empleado);

        /* Permission::firstOrCreate(['name' => 'puede.ver.entidades_financieras'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.entidades_financieras'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.entidades_financieras'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.entidades_financieras'])->assignRole($empleado); */

        Permission::firstOrCreate(['name' => 'puede.ver.configuracion'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.editar.configuracion'])->assignRole($empleado);

        /* Permission::firstOrCreate(['name' => 'puede.ver.carrito'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.editar.carrito'])->assignRole($cliente); */

        //
        Permission::firstOrCreate(['name' => 'puede.ver.notificaciones_clientes'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.crear.notificaciones_clientes'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.eliminar.notificaciones_clientes'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.notificaciones_generales'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.ver.chat_linea'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.ver.activar_app'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.ver.mis_reportes'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.ver.mejoramiento'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.crear.mejoramiento'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.editar.mejoramiento'])->assignRole($empleado);

        Permission::firstOrCreate(['name' => 'puede.ver.solicitud_mejoramiento'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.ver.email_marketing'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.ver.facturacion_planes'])->assignRole($empleado);
        Permission::firstOrCreate(['name' => 'puede.ver.score_crediticio'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.ver.adquirir_servicio'])->assignRole($cliente);
        Permission::firstOrCreate(['name' => 'puede.ver.reporte_credito'])->assignRole($cliente);
    }
}
