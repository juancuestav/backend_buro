<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\VerificarCuentaRequest;
use App\Http\Resources\Usuario\VerificarCuentaResource;
use App\Models\User;
use App\Models\Usuario\VerificarCuenta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Config\RutasStorage;
use Src\Shared\GuardarImagenIndividual;
use Src\Shared\Utils;

class VerificarCuentaController extends Controller
{
    private $entidad = 'Verificar cuenta';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = VerificarCuentaResource::collection(VerificarCuenta::ignoreRequest([''])->filter()->get());
        return response()->json(compact('results'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VerificarCuentaRequest $request)
    {
        try {
            $datos = $request->validated();
            DB::beginTransaction();

            $datos['documento_identidad_anverso'] = (new GuardarImagenIndividual($datos['documento_identidad_anverso'], RutasStorage::VERIFICAR_CUENTA))->execute();
            $datos['documento_identidad_reverso'] = (new GuardarImagenIndividual($datos['documento_identidad_reverso'], RutasStorage::VERIFICAR_CUENTA))->execute();
            $datos['documento_identidad_selfie'] = (new GuardarImagenIndividual($datos['documento_identidad_selfie'], RutasStorage::VERIFICAR_CUENTA))->execute();

            $usuario = User::find($datos['user_id']);
            $usuario->estado_verificacion = User::EN_ESPERA_VERIFICACION;
            $usuario->save();

            $examen = VerificarCuenta::create($datos);
            $modelo = new VerificarCuentaResource($examen);
            $mensaje = Utils::obtenerMensaje($this->entidad, 'store');
            DB::commit();
            return response()->json(compact('mensaje', 'modelo'));
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Ha ocurrido un error al insertar el registro de examen' . $e->getMessage() . ' ' . $e->getLine()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(VerificarCuenta $verificar_cuenta)
    {
        $modelo = new VerificarCuentaResource($verificar_cuenta);
        return response()->json(compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VerificarCuentaRequest $request, VerificarCuenta $verificar_cuenta)
    {
        try {
            DB::beginTransaction();
            
            //if ($request->isMethod('patch')) {
                $keys = $request->keys();
                unset($keys['id']);
                $datos = $request->only($keys);
                
                $datos['documento_identidad_anverso'] = $datos['documento_identidad_anverso'] && Utils::esBase64($datos['documento_identidad_anverso']) ? (new GuardarImagenIndividual($datos['documento_identidad_anverso'], RutasStorage::VERIFICAR_CUENTA))->execute() : $datos['documento_identidad_anverso'];
                $datos['documento_identidad_reverso'] = $datos['documento_identidad_reverso'] && Utils::esBase64($datos['documento_identidad_reverso']) ? (new GuardarImagenIndividual($datos['documento_identidad_reverso'], RutasStorage::VERIFICAR_CUENTA))->execute() : $datos['documento_identidad_reverso'];
                $datos['documento_identidad_selfie'] = $datos['documento_identidad_selfie'] && Utils::esBase64($datos['documento_identidad_selfie']) ? (new GuardarImagenIndividual($datos['documento_identidad_selfie'], RutasStorage::VERIFICAR_CUENTA))->execute() : $datos['documento_identidad_selfie'];
                // $datos['documento_identidad_reverso'] = (new GuardarImagenIndividual($datos['documento_identidad_reverso'], RutasStorage::VERIFICAR_CUENTA))->execute();
                // $datos['documento_identidad_selfie'] = (new GuardarImagenIndividual($datos['documento_identidad_selfie'], RutasStorage::VERIFICAR_CUENTA))->execute();

                // Log::channel('testing')->info('Log', ['keys', $keys]);

                $verificar_cuenta->update($datos);

                if ($datos['estado_verificacion']) {
                    $usuario = User::find($verificar_cuenta->user_id);
                    $usuario->estado_verificacion = $datos['estado_verificacion'];
                    $usuario->save();
                }
            /*} else {
                $verificar_cuenta->update($datos);
            }*/

            $modelo = new VerificarCuentaResource($verificar_cuenta->refresh());
            $mensaje = Utils::obtenerMensaje($this->entidad, 'update');
            DB::commit();
            return response()->json(compact('mensaje', 'modelo'));
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Ha ocurrido un error al actualizar el registro de examen' . $e->getMessage() . ' ' . $e->getLine()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
