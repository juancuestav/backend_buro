<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Src\Config\Permisos;

class PermisoRolController extends Controller
{
    public function listarPermisos(Role $rol)
    {
        return response()->json(['rol' => $rol->name, 'permisos' => $rol->getPermissionNames()]);
    }

    public function asignarPermisosUsuario(Request $request)
    {
        /*$empleado = User::find($request->empleado_id);
        switch ($request->tipo_sincronizacion) {
            case 'ASIGNAR':
                $empleado->user->givePermissionTo($request->permisos);
                break;
            case 'ELIMINAR':
                $empleado->user->permissions()->detach($request['permisos']);
                $empleado->user->forgetCachedPermissions();
                break;
            default:
                break;
        }
        return response()->json(['mensaje' => 'Se actualizaron los permisos del usuario', 'permisos' => $empleado->user->permissions]);*/
    }
    public function asignarPermisos(Request $request)
    {
        $rol = Role::find($request->id_rol);
        $permisos = $rol->permissions->pluck('id')->toArray();
        $request_permisos = $request['permisos'];
        $resultado = array_diff($request_permisos, $permisos);
        switch ($request['tipo_sincronizacion']) {
            case 'ASIGNAR':
                $rol->permissions()->attach($resultado);
                $rol->forgetCachedPermissions();
                $rol->load('permissions');
                break;
            case 'ELIMINAR':
                $rol->permissions()->detach($request_permisos);
                $rol->forgetCachedPermissions();
                $rol->load('permissions');
                break;
            default:
                break;
        }
        return response()->json(['mensaje' => 'Se actualizaron los permisos del rol', 'rol' => $rol->name, 'permisos' => $rol->getPermissionNames()]);
    }
    
    public function crearPermisoRol(Request $request)
    {
        $roles = Role::whereIn('id', $request->roles)->get();
        $permisos = [];
        if ($request->permiso_personalizado) {
            $permiso = Permission::firstOrCreate(['name' => strtolower($request->name)])->syncRoles($roles);
            return response()->json(['mensaje' => 'Se creó un permiso exitosamente',  'permiso' => $permiso]);
        } else {
            if ($request->boton) $permisos[] = Permission::firstOrCreate(['name' => Permisos::BOTON . strtolower($request->name)])->syncRoles($roles);
            if ($request->autorizar) $permisos[] = Permission::firstOrCreate(['name' =>Permisos::AUTORIZAR . strtolower($request->name)])->syncRoles($roles);
            if ($request->acceder) $permisos[] = Permission::firstOrCreate(['name' => Permisos::ACCEDER . strtolower($request->name)])->syncRoles($roles);
            if ($request->ver) $permisos[] = Permission::firstOrCreate(['name' => Permisos::VER  . strtolower($request->name)])->syncRoles($roles);
            if ($request->crear) $permisos[] = Permission::firstOrCreate(['name' => Permisos::CREAR . strtolower($request->name)])->syncRoles($roles);
            if ($request->editar) $permisos[] = Permission::firstOrCreate(['name' => Permisos::EDITAR . strtolower($request->name)])->syncRoles($roles);
            if ($request->eliminar) $permisos[] = Permission::firstOrCreate(['name' => Permisos::ELIMINAR . strtolower($request->name)])->syncRoles($roles);
            return response()->json(['mensaje' => 'Se crearon exitosamente los permisos',  'permisos' => $permisos]);
        }
    }
}
