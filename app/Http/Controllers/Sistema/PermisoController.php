<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sistema\PermisoRequest;
use App\Http\Resources\Sistema\PermisoResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Src\Config\Permisos;
use Src\Shared\Utils;

class PermisoController extends Controller
{
    private string $entidad = 'Permiso';
    /**
     * Display a listing of all permissions.
     *
     * @return JsonResponse
     */
    public function index()
    {
        if (request('tipo_filtro') == 'POR ROL') return $this->listarPermisosPorRol();
        $results = PermisoResource::collection(Permission::all());
        return response()->json(compact('results'));
    }

    public function listarPermisosPorUsuario(Request $request)
    {
        $user = User::find($request['usuario_id']);
        switch ($request['tipo']) {
            case 'ASIGNADOS':
                $permisos_asignados = $user->getPermissionsViaRoles();
                $results = $permisos_asignados;

                break;
            case 'NO ASIGNADOS':
                $permisos_asignados = $user->permissions; //Permisos asignados por roles
                $permisos_no_asignados = Permission::whereNotIn('id', $permisos_asignados->pluck('id')->toArray())->get();
                $results = $permisos_no_asignados;
                break;
            default:
                $results = DB::table('role_has_permissions')
                    ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->get();
        }

        $permisos_usuario = $user->getDirectPermissions();

        return response()->json(compact('results', 'permisos_usuario'));
    }

    public function listarPermisosPorRol()
    {
        switch (request('tipo')) {
            case 'ASIGNADOS':
                $results = Role::find(request('rol_id'))->permissions;
                break;
            case 'NO ASIGNADOS':
                $id_permisos = Role::find(request('rol_id'))->permissions->pluck('id')->toArray();
                $results = Permission::whereNotIn('id', $id_permisos)->get();
                break;
            default:
                $results = DB::table('role_has_permissions')
                    ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->get();
                break;
        }


        return response()->json(compact('results'));
    }

    public function asignarPermisos(Request $request, Role $rol)
    {
        $request->validate(['permissions' => 'exists:permissions,id']);
        $rol->permissions()->sync($request->permissions);
        return response()->json(['mensaje' => 'Se actualizaron los permisos del rol', 'rol' => $rol->name, 'permisos' => $rol->getPermissionNames()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermisoRequest $request
     * @return JsonResponse
     */
    public function store(PermisoRequest $request)
    {
        //Respuesta
        $request->validated();
        $modelo = Permission::create($request->all());
        $modelo = new PermisoResource($modelo);
        $mensaje = Utils::obtenerMensaje($this->entidad, 'store');

        return response()->json(compact('mensaje', 'modelo'));
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permiso
     * @return JsonResponse
     */
    public function show(Permission $permiso)
    {
        $modelo = new PermisoResource($permiso);
        return response()->json(compact('modelo'));
    }

    /**per
     * Update the specified resource in storage.
     *
     * @param PermisoRequest $request
     * @param Permission $permiso
     * @return JsonResponse
     */
    public function update(PermisoRequest $request, Permission $permiso)
    {
        //Respuesta
        $permiso->update($request->validated());
        $modelo = new PermisoResource($permiso->refresh());
        $mensaje = Utils::obtenerMensaje($this->entidad, 'update');

        return response()->json(compact('mensaje', 'modelo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permiso
     * @return JsonResponse
     */
    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        $mensaje = Utils::obtenerMensaje($this->entidad, 'destroy');
        return response()->json(compact('mensaje'));
    }

    public function crearPermisoRol(Request $request)
    {
        $roles = Role::whereIn('id', $request['roles'])->get();
        $permisos = [];
        if ($request['permiso_personalizado']) {
            $permiso = Permission::firstOrCreate(['name' => strtolower($request['name'])])->syncRoles($roles);
            return response()->json(['mensaje' => 'Se creó un permiso exitosamente',  'permiso' => $permiso]);
        } else {
            if ($request['autorizar']) array_push($permisos, self::crearAsignarPermiso(Permisos::AUTORIZAR . $request['name'], $roles));
            if ($request['acceder']) array_push($permisos, self::crearAsignarPermiso(Permisos::ACCEDER . $request['name'], $roles));
            if ($request['ver']) array_push($permisos, self::crearAsignarPermiso(Permisos::VER . $request['name'], $roles));
            if ($request['crear']) array_push($permisos, self::crearAsignarPermiso(Permisos::CREAR . $request['name'], $roles));
            if ($request['editar']) array_push($permisos, self::crearAsignarPermiso(Permisos::EDITAR . $request['name'], $roles));
            if ($request['eliminar']) array_push($permisos, self::crearAsignarPermiso(Permisos::ELIMINAR . $request['name'], $roles));

            return response()->json(['mensaje' => 'Se crearon exitosamente los permisos',  'permisos' => $permisos]);
        }
    }

    private function crearAsignarPermiso($name, $roles)
    {
        return Permission::firstOrCreate(['name' => strtolower($name), 'guard_name' => 'web'])->syncRoles($roles);
    }
}
