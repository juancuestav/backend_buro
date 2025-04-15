<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Models\TipoIdentificacion;
use App\Models\User;
use App\Rules\Identificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PerfilController extends Controller
{
	public function page()
	{
		$tipos_identificaciones = TipoIdentificacion::all();
		$usuario = new UsuarioResource(Auth::user());
		return Inertia::render('perfil/view/PerfilPage.vue', compact('usuario', 'tipos_identificaciones'));
	}

	public function actualizar(Request $request)
	{
		$tipo_identificacion = $request["tipo_identificacion"];

		$validador = Validator::make($request->all(), [
			'name' => 'required|min:4|string|max:255',
			'apellidos' => 'nullable|min:4|string|max:255',
			'celular' => 'required|min:4|string|max:255',
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
			'tipo_identificacion' => ['required', 'integer'],
			'identificacion' => ['required', 'string', 'max:13', Rule::unique('users')->ignore(Auth::id()), new Identificacion(intval($tipo_identificacion))]
		]);

		$user = User::find(Auth::user()->id);
		$user->update($validador->validated());

		return response()->json(['mensaje' => 'Información actualizada exitosamente!']);
	}
}
