<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserProfileRequest;
use App\Http\Resources\Admin\UserProfileResource;
use App\Models\Admin\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $user_profile)
    {
        return response()->json(['modelo' => new UserProfileResource($user_profile)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function update(UserProfileRequest $request, UserProfile $user_profile)
    {
        // Actualizar el campo 'puntuacion' con el valor de la solicitud
        $user_profile->puntuacion = $request['puntuacion'];
        $user_profile->save();

        // Retornar respuesta exitosa
        return response()->json([
            'mensaje' => 'Perfil actualizado exitosamente.',
            'modelo' => $user_profile,
        ], 200);
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
