<?php

use App\Http\Controllers\Admin\BasesDatos\RegistroCivilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Sistema\ConfiguracionGeneralController;
use App\Models\Ciudad;
use App\Models\Provincia;
use App\Models\TipoIdentificacion;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login']);
Route::post('registrar', [LoginController::class, 'registrar']);
Route::get('configuraciones-generales', [ConfiguracionGeneralController::class, 'index']);
Route::post('configuraciones-generales', [ConfiguracionGeneralController::class, 'store']);
Route::get('tipos-identificaciones', fn () => response()->json(['results' => TipoIdentificacion::all()]));
Route::get('provincias', fn () => response()->json(['results' => Provincia::all()]));
Route::get('ciudades', fn () => response()->json(['results' => Ciudad::filter()->get()]));