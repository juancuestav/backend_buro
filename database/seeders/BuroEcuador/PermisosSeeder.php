<?php

namespace Database\Seeders\BuroEcuador;

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
     * php artisan db:seed --class="Database\Seeders\BuroEcuador\PermisosSeeder"
     * @return void
     */
    public function run()
    {
        $administrador = Role::firstOrCreate(['name' => User::ROL_ADMINISTRADOR]);
        $cliente = Role::firstOrCreate(['name' => User::ROL_CLIENTE]);
        $empleado = Role::firstOrCreate(['name' => User::ROL_EMPLEADO]);
        $empresa = Role::firstOrCreate(['name' => User::ROL_EMPRESA]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'tablero'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'archivos_reportes'])->syncRoles([$administrador, $cliente, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'archivos_reportes'])->syncRoles([$administrador, $cliente, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'archivos_reportes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'archivos_reportes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::ELIMINAR . 'archivos_reportes'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'notificaciones'])->syncRoles([$administrador, $cliente, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'notificaciones'])->syncRoles([$administrador, $cliente, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'formulario_contacto'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'formulario_contacto'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'formulario_contacto'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'consultar_reportes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'consultar_reportes'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'reporte_credito'])->syncRoles([$administrador, $cliente, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'reporte_credito'])->syncRoles([$administrador, $cliente, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'mis_reportes'])->syncRoles([$administrador, $cliente, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'mis_reportes'])->syncRoles([$administrador, $cliente, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'solicitud_mejoramiento'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'solicitud_mejoramiento'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'solicitud_mejoramiento'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'notificar_clientes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'notificar_clientes'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'notificaciones_generales'])->syncRoles([$administrador, $cliente, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'notificaciones_generales'])->syncRoles([$administrador, $cliente, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'chat_linea'])->syncRoles([$administrador, $cliente, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'facturacion_planes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'facturacion_planes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'facturacion_planes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'facturacion_planes'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'score_crediticio'])->syncRoles([$administrador, $cliente, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'reportes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'reportes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'reportes'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'reportes'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'servicios'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'servicios'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'servicios'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'servicios'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'categorias'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'categorias'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'categorias'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'categorias'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'pedidos'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'pedidos'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'pedidos'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'pedidos'])->syncRoles([$administrador, $empleado]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'email_marketing'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'email_marketing'])->syncRoles([$administrador, $empleado]);


        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'mejoramiento'])->syncRoles([$administrador, $empleado, $cliente]); // Solicitar mejoramiento
        Permission::firstOrCreate(['name' => Permisos::VER . 'mejoramiento'])->syncRoles([$administrador, $empleado, $cliente]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'mejoramiento'])->syncRoles([$administrador, $empleado, $cliente]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'verifica_cuenta'])->syncRoles([$cliente]);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'activar_app'])->syncRoles([$cliente]);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'adquirir_servicio'])->syncRoles([$cliente]);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'aprobar_verificar_cuenta'])->syncRoles([$cliente]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'usuarios'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'usuarios'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'usuarios'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'usuarios'])->syncRoles([$administrador]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'ofertas_disponibles'])->syncRoles([$cliente]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'popup'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'popup'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'popup'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'popup'])->syncRoles([$administrador]);

        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'accesos_directos'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'accesos_directos'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'accesos_directos'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'accesos_directos'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::ELIMINAR . 'accesos_directos'])->syncRoles([$administrador]);
        
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'puntuacion_cliente'])->syncRoles([$administrador, $empleado, $cliente]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'puntuacion_cliente'])->syncRoles([$administrador, $empleado, $cliente]);
        Permission::firstOrCreate(['name' => Permisos::CREAR . 'puntuacion_cliente'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::EDITAR . 'puntuacion_cliente'])->syncRoles([$administrador, $empleado]);
        Permission::firstOrCreate(['name' => Permisos::ELIMINAR . 'puntuacion_cliente'])->syncRoles([$administrador, $empleado]);

        /************************
         * Modulo base de datos
         ************************/
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'dashboard_precalifica'])->syncRoles([$administrador]);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'modulo_bases_de_datos'])->syncRoles([$administrador, $empleado, $empresa]);
        // Registro civil
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'registro_civil'])->syncRoles([$administrador, $empleado, $empresa]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'registro_civil'])->syncRoles([$administrador, $empleado, $empresa]);
        // Iess
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'iess'])->syncRoles([$administrador, $empleado, $empresa]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'iess'])->syncRoles([$administrador, $empleado, $empresa]);
        // Ant
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'ant'])->syncRoles([$administrador, $empleado, $empresa]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'ant'])->syncRoles([$administrador, $empleado, $empresa]);
        // Banco
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'banco'])->syncRoles([$administrador, $empleado, $empresa]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'banco'])->syncRoles([$administrador, $empleado, $empresa]);
        // SRI
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'sri'])->syncRoles([$administrador, $empleado, $empresa]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'sri'])->syncRoles([$administrador, $empleado, $empresa]);
        // Busqueda general
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'busqueda_general'])->syncRoles([$administrador, $empleado, $empresa]);
        Permission::firstOrCreate(['name' => Permisos::VER . 'busqueda_general'])->syncRoles([$administrador, $empleado, $empresa]);

        // Super administrador
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'roles']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'permisos']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'permisos_roles']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'permisos_usuarios']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'configuraciones_generales']);
        Permission::firstOrCreate(['name' => Permisos::ACCEDER . 'modulo_administracion']);
    }
}
