<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserInfoResource;
use App\Http\Resources\UsuarioResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\FacturacionPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificarEmailMail;
use App\Rules\Identificacion;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //if (!Auth::attempt($request->only('email', 'password'))) {
        //return response()->json(['mensaje' => 'Usuario o contraseña incorrectos'], 401);
        //}
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request['email'])->first();

        /* if (!$user->activo) {
            throw ValidationException::withMessages([
                'inactivo' => ['Usuario inactivo'],
            ]);
        } */

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Usuario o contraseña incorrectos'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Conectar
        $user->conectado = true;
        $user->hora_conexion = Carbon::now();
        $user->save();
        Session::put('user_id', $user->id);

        // Modelo
        $modelo = new UserInfoResource($user);

        return response()->json(['mensaje' => 'Usuario autenticado con éxito', 'access_token' => $token, 'token_type' => 'Bearer', 'modelo' => $modelo]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $user = $request->user();
        $user->conectado = false;
        $user->save();
        //User::find(Auth::id())->currentAccessToken()->delete();

    }

    public function registrar(Request $request)
    {
        return DB::transaction(function () use ($request) {
            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => ['required', 'string', new Password, 'confirmed'],
                'apellidos' => ['required', 'string', 'max:255'],
                'celular' => ['required', 'max:10', new PhoneNumber()],
                'tipo_identificacion' => ['required', 'integer'],
                'tipo_cliente' => ['required', 'string'],
                'identificacion' => ['required', 'unique:users', 'string', 'max:13', new Identificacion(intval($request['tipo_identificacion']))],
            ])->validate();

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'apellidos' => $request['apellidos'],
                'edad' => $request['edad'],
                'direccion' => $request['direccion'],
                'celular' => $request['celular'],
                'tipo_identificacion' => $request['tipo_identificacion'],
                'identificacion' => $request['identificacion'],
                // 'codigo_reclutador' => $request['codigo_reclutador'],
            ])->assignRole(User::ROL_CLIENTE);

            $user->userProfile()->create([
                'tipo_cliente' => $request['tipo_cliente'],
                'provincia_id' => $request['provincia'],
                'canton_id' => $request['canton'],
            ]);

            $facturacion = new FacturacionPlan();
            $facturacion->usuario = $user->id;
            $facturacion->save();

            // Codigo
            $codigo_verificacion = random_int(1000, 9999);
            $user->codigo_verificacion = $codigo_verificacion;

            // Conectar
            $user->conectado = true;
            $user->hora_conexion = Carbon::now();
            $user->save();
            Session::put('user_id', $user->id);

            if (env('APP_ID', '1') == User::APP_ID_BURO_CREDITO_ECUADOR) Mail::to($user->email)->send(new VerificarEmailMail($codigo_verificacion));

            // return $this->login($request);

            return $user;
        });
    }
}
