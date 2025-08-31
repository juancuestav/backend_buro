<?php

use App\Http\Controllers\Admin\AccesoDirectoController;
use App\Http\Controllers\Admin\ActivarAppController;
use App\Http\Controllers\Admin\ArchivoController;
use App\Http\Controllers\Admin\BasesDatos\IessController;
use App\Http\Controllers\Admin\BasesDatos\RegistroCivilController;
use App\Http\Controllers\Admin\BasesDatos\AntController;
use App\Http\Controllers\Admin\BasesDatos\BancoController;
use App\Http\Controllers\Admin\BasesDatos\BusquedaGeneralController;
use App\Http\Controllers\Admin\BasesDatos\SriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacturacionPlanesController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\MejoramientoController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\SolicitudMejoramientoController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CrearStorageLinkController;
use App\Http\Controllers\NotificacionesClienteController;
use App\Http\Controllers\Reporte\ArchivoReporteController;
use App\Http\Controllers\Sistema\ConfiguracionGeneralController;
use App\Http\Controllers\Sistema\NotificacionController;
use App\Http\Controllers\Sistema\PermisoController;
use App\Http\Controllers\Sistema\RolController;
use App\Http\Controllers\Usuario\VerificarCuentaController;
use App\Models\TipoIdentificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserInfoResource;
use App\Http\Controllers\Admin\NotificacionController as NotificacionFormularioContactoController;
use App\Http\Controllers\Admin\PayPhoneController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Sistema\DashboardPrecalificaController;
use App\Http\Controllers\Sistema\PermisoRolController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Generar token para autenticar
Route::post('/user/logout', [LoginController::class, 'logout']);

// Creación de storage:link en hosting compartido
Route::get('storage-link', CrearStorageLinkController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();

    // Esta pagado
    /* $facturacion = FacturacionPlan::where('usuario', $user->id)->first();
    $pagado = $facturacion?->pagado; */

    $modelo = new UserInfoResource($user);
    /*$modelo['permisos'] = $user->allPermissions;
    $modelo['pagado'] = $pagado;*/

    return $modelo;
});

// El frontend usa esta ruta para obtener los permisos del usuario autenticado
Route::middleware('auth:sanctum')->get('/user/permisos', function (Request $request) {
    return $request->user()->allPermissions;
});

// Verificar correo
Route::post('/user/verificar-codigo', [UsuarioController::class, 'verificarCodigo']);
Route::get('/user/reenviar-codigo', [UsuarioController::class, 'reenviarCodigo']);

Route::get('/tablero', [DashboardController::class, 'index']);

// Route::resource('gestor-archivos', GestorArchivosController::class)->only(['index']);
// Route::resource('carpetas', CarpetaController::class)->only(['store', 'show', 'update', 'destroy']);
// Route::resource('archivos', ArchivoController::class)->only(['store', 'show', 'update', 'destroy']);
Route::get('tipos-identificaciones', fn () => response()->json(['results' => TipoIdentificacion::all()])); // revisar si es publica

Route::apiResources([
    'usuarios' => UsuarioController::class,
    'servicios' => ServicioController::class,
    'pedidos' => PedidoController::class,
    'categorias' => CategoriaController::class,
    'popup' => PopupController::class,
    'roles' => RolController::class,
    'reportes' => ReporteController::class,
    // 'tareas' => TareaController::class,
//    'retiros' => RetiroController::class,
    'verificar-cuenta' => VerificarCuentaController::class,
    'archivos-reportes' => ArchivoReporteController::class,
    'accesos-directos' => AccesoDirectoController::class,
    'user-profiles' => UserProfileController::class,
], [
    'parameters' => [
        'retiros' => 'tarea',
        'verificar-cuenta' => 'verificar_cuenta',
        'archivos-reportes' => 'archivo_reporte',
        'accesos-directos' => 'acceso_directo',
        'user-profiles' => 'user_profile',
    ],
]);

// Route::apiResource('configuraciones-generales', ConfiguracionGeneralController::class)->only(['index', 'store']);
// Route::post('configuraciones-generales', [ConfiguracionGeneralController::class, 'store']);

Route::apiResource('solicitudes-mejoramiento', SolicitudMejoramientoController::class);
Route::apiResource('mejoramiento', MejoramientoController::class)->except(['show', 'destroy']);
Route::get('activar-app', [ActivarAppController::class, 'index']);
Route::get('activar-app/pagado', [ActivarAppController::class, 'pagado']);
Route::resource('notificaciones-cliente', NotificacionesClienteController::class)->only(['index', 'store', 'update', 'destroy']);
Route::get('marketings', [MarketingController::class, 'index']);
Route::resource('facturacion-planes', FacturacionPlanesController::class)->only(['index', 'update', 'destroy']);
Route::resource('notificaciones', NotificacionController::class)->only(['index', 'show', 'update']);
Route::resource('notificaciones-form-contacto', NotificacionFormularioContactoController::class)->only(['index', 'show', 'update']);
Route::get('pedidos/download-pdf/{pedido}', [PedidoController::class, 'downloadPdf']);
Route::get('registro-civil', [RegistroCivilController::class, 'index']);
Route::get('iess', [IessController::class, 'index']);
Route::get('ant', [AntController::class, 'index']);
Route::get('banco', [BancoController::class, 'index']);
Route::get('sri', [SriController::class, 'index']);
Route::get('busqueda-general', [BusquedaGeneralController::class, 'index']);
Route::get('dashboard-precalifica', [DashboardPrecalificaController::class, 'index']);
Route::get('usuarios-dashboard-precalifica', [DashboardPrecalificaController::class, 'usuariosDashboardPrecalifica']);

// Estados de las tareas
/*Route::post('tareas/asignar/{tarea}', [TareaController::class, 'asignar']);
Route::post('tareas/ejecutar/{tarea}', [TareaController::class, 'ejecutar']);
Route::post('tareas/completar/{tarea}', [TareaController::class, 'completar']);
Route::post('tareas/pausar/{tarea}', [TareaController::class, 'pausar']);
Route::post('tareas/reanudar/{tarea}', [TareaController::class, 'reanudar']);
Route::post('tareas/suspender/{tarea}', [TareaController::class, 'suspender']);
Route::post('tareas/cancelar/{tarea}', [TareaController::class, 'cancelar']);
Route::get('tareas/pausas/{tarea}', [TareaController::class, 'pausas']);*/

//Route::get('tareas-asignadas', [TareaAsignadaController::class, 'index']);

// Estados de los retiros
/*Route::post('retiros/asignar/{retiro}', [RetiroController::class, 'asignar']);
Route::post('retiros/ejecutar/{retiro}', [RetiroController::class, 'ejecutar']);
Route::post('retiros/realizar/{retiro}', [RetiroController::class, 'realizar']);
Route::post('retiros/pausar/{retiro}', [RetiroController::class, 'pausar']);
Route::post('retiros/reanudar/{retiro}', [RetiroController::class, 'reanudar']);
Route::post('retiros/suspender/{retiro}', [RetiroController::class, 'suspender']);
Route::post('retiros/cancelar/{retiro}', [RetiroController::class, 'cancelar']);
Route::get('retiros/pausas/{retiro}', [RetiroController::class, 'pausas']);

Route::get('retiros-asignados', [RetiroAsignadoController::class, 'index']);*/

// Route::resource('accesos-directos', AccesoDirectoController::class)->only(['store']);
// Route::resource('depositos-transferencias', DepositoTransferenciaController::class)->only(['index', 'create', 'store', 'show', 'edit']);
// Route::resource('entidades-financieras', EntidadFinancieraController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
/*Route::resource('cambiar-contrasena', CambiarContrasenaController::class)->only(['store']);
Route::resource('permisos', PermisoController::class)->only(['index', 'show', 'update']);
Route::resource('mis-reportes', MiReporteController::class)->only(['index', 'store', 'show', 'update']);
Route::resource('consultar-reportes', ConsultarReporteController::class)->only(['index', 'store', 'show', 'update', 'destroy', 'edit']);
Route::resource('notificaciones-cliente', NotificacionesClienteController::class)->only(['index', 'store', 'update', 'destroy']);*/

// Permisos
Route::get('permisos', [PermisoController::class, 'index']);
Route::post('crear-permiso', [PermisoController::class, 'crearPermisoRol']);
Route::post('asignar-permisos', [PermisoRolController::class, 'asignarPermisos']);
// Route::post('asignar-permisos-usuario', [PermisoRolController::class, 'asignarPermisosUsuario']);

/*************************
 * Archivos polimorficos
 *************************/
Route::apiResource('archivos', ArchivoController::class)->only('destroy');

Route::get('accesos-directos/files/{acceso_directo}', [AccesoDirectoController::class, 'indexFiles']);
Route::post('accesos-directos/files/{acceso_directo}', [AccesoDirectoController::class, 'storeFiles']);

Route::get('archivos-reportes/files/{archivo_reporte}', [ArchivoReporteController::class, 'indexFiles']);
Route::post('archivos-reportes/files/{archivo_reporte}', [ArchivoReporteController::class, 'storeFiles']);