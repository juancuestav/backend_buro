<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\UsuarioResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Mail\VerificarEmailMail;
use App\Models\FacturacionPlan;
use App\Models\TipoIdentificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Src\App\Sistema\PaginationService;

class UsuarioController extends Controller
{
    protected PaginationService $paginationService;

    public function __construct()
    {
        /* $this->middleware('can:puede.ver.servicios')->only('listar');
        $this->middleware('can:puede.ver.servicios')->only('index');
        $this->middleware('can:puede.ver.servicios')->only('page'); */
        $this->paginationService = new PaginationService();
    }


    /**
     * Listar
     */
    public function index()
    {
        $search = request('search');
        $paginate = request('paginate');

        if ($search) {
            $query = User::whereHas('userProfile', function ($q) use ($search) {
                $q->whereHas('canton', function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%');
                })->orWhereHas('provincia', function ($q) use ($search) {
                    $q->where('nombre', 'like', '%' . $search . '%');
                });
            })->orWhere('identificacion', 'like', '%' . $search . '%');
        } else {
            $query = User::ignoreRequest(['campos', 'page', 'paginate'])->filter()->orderBy('id', 'desc');
        }

        if ($paginate) $results = $this->paginationService->paginate($query, 100, request('page'));
        else $results = $query->get();
        return UsuarioResource::collection($results);
    }


    /**
     * Consultar
     */
    public function show(User $usuario)
    {
        return response()->json(['modelo' => new UsuarioResource($usuario)]);
    }


    /**
     * Guardar
     */
    public function store(UsuarioRequest $request)
    {
        $usuario = User::create([
            'name' => $request['name'],
            'apellidos' => $request['apellidos'],
            'celular' => $request['celular'],
            'tipo_identificacion' => $request['tipo_identificacion'],
            'identificacion' => $request['identificacion'],
            'direccion' => $request['direccion'],
            'edad' => $request['edad'],
            'email' => $request['email'],
            'codigo_reclutador' => $request['codigo_reclutador'],
            'password' => Hash::make($request['password']),
        ]);

        $roles = Role::select('name')->whereIn('id', $request['rol'])->pluck('name')->toArray();
        $usuario->syncRoles($roles);

        if (in_array(User::ROL_CLIENTE, $roles)) {
            $facturacion = new FacturacionPlan();
            $facturacion->usuario = $usuario->id;
            $facturacion->save();
        }

        // Permiso
        if ($request['puede_recibir_notificaciones']) {
            $usuario->givePermissionTo('puede.recibir.notificaciones');
        }

        $usuario->userProfile()->create([
            'tipo_cliente' => $request['tipo_cliente'],
            'provincia_id' => $request['provincia'],
            'canton_id' => $request['canton'],
            'limite_consultas' => $request['limite_consultas'],
        ]);

        return response()->json(['mensaje' => 'Usuario guardado exitosamente!', 'modelo' => new UsuarioResource($usuario)]);
    }

    /**
     * Actualizar
     */
    public function update(UsuarioRequest $request, User $usuario)
    {
        $usuario->update([
            'name' => $request['name'],
            'apellidos' => $request['apellidos'],
            'celular' => $request['celular'],
            'tipo_identificacion' => $request['tipo_identificacion'],
            'identificacion' => $request['identificacion'],
            'direccion' => $request['direccion'],
            'edad' => $request['edad'],
            'email' => $request['email'],
            'codigo_reclutador' => $request['codigo_reclutador'],
        ]);

        // Rol
        $roles = Role::select('name')->whereIn('id', $request['rol'])->pluck('name')->toArray();
        $usuario->syncRoles($roles);

        // Permiso
        if ($request['puede_recibir_notificaciones']) {
            $usuario->givePermissionTo('puede.recibir.notificaciones');
        } else {
            $usuario->revokePermissionTo('puede.recibir.notificaciones');
        }

        // Contraseña
        if ($request['password']) {
            $usuario->password = Hash::make($request['password']);
            $usuario->save();
        }

        $usuario->userProfile()->update([
            'tipo_cliente' => $request['tipo_cliente'],
            'provincia_id' => $request['provincia'],
            'canton_id' => $request['canton'],
            'limite_consultas' => $request['limite_consultas'],
        ]);

        $usuario->refresh();
        return response()->json(['mensaje' => 'Usuario actualizado exitosamente!', 'modelo' => new UsuarioResource($usuario)]);
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json(['mensaje' => 'Eliminado exitosamente!']);
    }

    public function verificarCodigo(Request $request)
    {
        $codigo = $request['codigo'];
        $usuario = User::find(Auth::id());
        if ($codigo == $usuario->codigo_verificacion) {
            $usuario->email_verified_at = now();
            $usuario->save();
            return true;
        }

        return false;
    }

    public function reenviarCodigo()
    {
        $user = User::find(Auth::id());
        $codigo_verificacion = rand(1000, 9999);
        $user->codigo_verificacion = $codigo_verificacion;
        $user->save();

        Mail::to($user->email)->send(new VerificarEmailMail($codigo_verificacion));
        return response()->json(['mensaje' => 'El nuevo código ha sido enviado a su correo electrónico registrado.']);
    }
}
