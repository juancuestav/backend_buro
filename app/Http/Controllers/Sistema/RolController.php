<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\Sistema\RolRequest;
use App\Http\Resources\Sistema\RolResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Src\Shared\Utils;

class RolController extends Controller
{
    private string $entidad = 'Rol';

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $results = Role::where('name', '!=', 'SUPERADMINISTRADOR')->get();
        $results = RolResource::collection($results);
        return response()->json(compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RolRequest  $request
     * @return JsonResponse
     */
    public function store(RolRequest $request)
    {
        //Respuesta
        $request->validated();
        // $datos['guard_name'] = 'web';
        $modelo = Role::create($request->all());
        $modelo = new RolResource($modelo);
        $mensaje = Utils::obtenerMensaje($this->entidad, 'store');

        return response()->json(compact('mensaje', 'modelo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id_rol)
    {
        $rol = Role::findOrFail($id_rol);
        $modelo = new RolResource($rol);
        return response()->json(compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RolRequest  $request
     * @param Role $rol
     * @return JsonResponse
     */
    public function update(RolRequest $request, Role $rol)
    {
        //Respuesta
        $request->validated();
        $rol = Role::find($request['id']);
        $rol->update($request->all());
        $modelo = new RolResource($rol->refresh());
        $mensaje = Utils::obtenerMensaje($this->entidad, 'update');

        return response()->json(compact('mensaje', 'modelo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();
        $mensaje = Utils::obtenerMensaje($this->entidad, 'destroy');
        return response()->json(compact('mensaje'));
    }
}
