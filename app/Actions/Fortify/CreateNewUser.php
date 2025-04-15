<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\Identificacion;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\FacturacionPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificarEmailMail;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'apellidos' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'max:10', new PhoneNumber()],
            'tipo_identificacion' => ['required', 'integer'],
            'identificacion' => ['required', 'unique:users', 'string', 'max:13', new Identificacion(intval($input['tipo_identificacion']))],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'apellidos' => $input['apellidos'],
            'edad' => $input['edad'],
            'direccion' => $input['direccion'],
            'celular' => $input['celular'],
            'tipo_identificacion' => $input['tipo_identificacion'],
            'identificacion' => $input['identificacion'],
        ])->assignRole(User::ROL_CLIENTE);

        $facturacion = new FacturacionPlan();
        $facturacion->usuario = $user->id;
        $facturacion->save();

        // Codigo
        $codigo_verificacion = rand(1000, 9999);
        $user->codigo_verificacion = $codigo_verificacion;

        // Conectar
        $user->conectado = true;
        $user->hora_conexion = Carbon::now();
        $user->save();
        Session::put('user_id', $user->id);

        Mail::to($user->email)->send(new VerificarEmailMail($codigo_verificacion));

        return $user;
    }
}
