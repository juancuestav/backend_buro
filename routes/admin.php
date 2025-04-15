<?php

use App\Http\Controllers\Admin\AccesoDirectoController;
use App\Http\Controllers\Admin\ActivarAppController;
use App\Http\Controllers\Admin\ArchivoController;
use App\Http\Controllers\Admin\CambiarContrasenaController;
use App\Http\Controllers\Admin\CarpetaController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\ConsultarReporteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositoTransferenciaController;
use App\Http\Controllers\Admin\EntidadFinancieraController;
use App\Http\Controllers\Admin\FacturacionPlanesController;
use App\Http\Controllers\Admin\GestorArchivosController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\MejoramientoController;
use App\Http\Controllers\Admin\MiPedidoController;
use App\Http\Controllers\Admin\MiReporteController;
use App\Http\Controllers\Admin\NotificacionController;
use App\Http\Controllers\Admin\PedidoController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\PerfilController;
use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\ServicioController;
use App\Http\Controllers\Admin\SolicitudMejoramientoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CrearStorageLinkController;
use App\Http\Controllers\NotificacionContactoController;
use App\Http\Controllers\NotificacionesClienteController;
use App\Http\Controllers\PrivateFilesController;
use App\Http\Controllers\PrivateImagesDepositoTransaccionController;
use App\Http\Resources\UsuarioResource;
use App\Models\NotificacionCliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// User
Route::get('user', fn () => new UsuarioResource(Auth::user()));

// Paginas Vue
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('gestor-archivos/page/', [GestorArchivosController::class, 'page'])->name('gestor-archivos.page');
Route::get('usuarios/page/', [UsuarioController::class, 'page'])->name('usuarios.page');
Route::get('perfil/page/', [PerfilController::class, 'page'])->name('perfil.page');
Route::get('notificaciones/page/', [NotificacionController::class, 'page']);
Route::get('servicios/page/', [ServicioController::class, 'page']);
Route::get('configuraciones/page/', [ConfiguracionController::class, 'page']);
Route::get('accesos-directos/page/', [AccesoDirectoController::class, 'page']);
Route::get('pedidos/page/', [PedidoController::class, 'page']);
Route::get('mis-pedidos/page/', [MiPedidoController::class, 'page']);
Route::get('depositos-transferencias/page/', [DepositoTransferenciaController::class, 'page']);
Route::get('entidades-financieras/page/', [EntidadFinancieraController::class, 'page']);
Route::get('categorias/page/', [CategoriaController::class, 'page']);
Route::get('popup/page/', [PopupController::class, 'page']);
Route::get('roles/page/', [RolController::class, 'page']);
Route::get('permisos/page/', [PermisoController::class, 'page']);
Route::get('cambiar-contrasena/page', [CambiarContrasenaController::class, 'page']);
Route::get('reportes/page', [ReporteController::class, 'page']);
Route::get('mis-reportes/page', [MiReporteController::class, 'page']);
Route::get('consultar-reportes/page', [ConsultarReporteController::class, 'page']);
Route::get('activar-app/page', [ActivarAppController::class, 'page']);
Route::get('facturacion-planes/page', [FacturacionPlanesController::class, 'page']);
Route::get('marketings/page', [MarketingController::class, 'page']);
Route::get('mejoramiento/page', [MejoramientoController::class, 'page']);
Route::get('solicitudes-mejoramiento/page', [SolicitudMejoramientoController::class, 'page']);
Route::get('notificaciones-cliente/page', [NotificacionesClienteController::class, 'page']);
Route::get(
    'notificaciones-generales/page',
    fn () =>
    Inertia::render('notificacionesGenerales/view/NotificacionGeneralPage.vue', ['notificaciones' =>  NotificacionCliente::orderBy('created_at', 'DESC')->get()->map(fn ($item) => [
        'id' => $item->id,
        'fecha' => Carbon::parse($item->created_at)->format('Y-m-d'),
        'mensaje' => $item->mensaje
    ])])
)->middleware('can:puede.ver.notificaciones_generales');
Route::get(
    'chat-en-linea/page',
    fn () =>
    Inertia::render('chatLinea/view/ChatLineaPage.vue', ['celular' => Config::get('buro.whatsapp')])
)->middleware('can:puede.ver.chat_linea');
// Route::post('reportes/pdf', [ReporteController::class, 'generarPDF']);

// Api Resources
Route::resource('gestor-archivos', GestorArchivosController::class)->only(['index']);
Route::resource('carpetas', CarpetaController::class)->only(['store', 'show', 'update', 'destroy']);
Route::resource('archivos', ArchivoController::class)->only(['store', 'show', 'update', 'destroy']);

Route::resource('usuarios', UsuarioController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('servicios', ServicioController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('configuraciones', ConfiguracionController::class)->only(['store']);
Route::resource('accesos-directos', AccesoDirectoController::class)->only(['store']);
Route::resource('pedidos', PedidoController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('depositos-transferencias', DepositoTransferenciaController::class)->only(['index', 'create', 'store', 'show', 'edit']);
Route::resource('entidades-financieras', EntidadFinancieraController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('categorias', CategoriaController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('notificaciones', NotificacionController::class)->only(['index', 'show', 'update']);
Route::resource('popup', PopupController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('roles', RolController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
Route::resource('cambiar-contrasena', CambiarContrasenaController::class)->only(['store']);
Route::resource('permisos', PermisoController::class)->only(['index', 'show', 'update']);
Route::resource('reportes', ReporteController::class)->only(['index', 'store', 'show', 'update']);
Route::resource('mis-reportes', MiReporteController::class)->only(['index', 'store', 'show', 'update']);
Route::resource('consultar-reportes', ConsultarReporteController::class)->only(['index', 'store', 'show', 'update', 'destroy', 'edit']);
Route::resource('facturacion-planes', FacturacionPlanesController::class)->only(['index', 'update', 'destroy']);
Route::resource('notificaciones-cliente', NotificacionesClienteController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('mejoramiento', MejoramientoController::class)->only(['index', 'store', 'update']);
Route::resource('solicitudes-mejoramiento', SolicitudMejoramientoController::class)->only(['index', 'store', 'update', 'show']);

// Pedidos
Route::post('pedidos/registrar-pago-efectivo', [PedidoController::class, 'registrarPagoEfectivo']);
Route::post('pedidos/anular', [PedidoController::class, 'anular']);
Route::get('pedidos/download-pdf/{pedido}', [PedidoController::class, 'downloadPdf']);

// Mis pedidos
Route::get('mis-pedidos', [MiPedidoController::class, 'index']);
Route::post('mis-pedidos/anular', [MiPedidoController::class, 'anular'])->name('mis-pedidos.anular');

// Otros
Route::get('storage/private/GestorArchivos/{archivo}', [PrivateFilesController::class, 'descargarArchivo']);
Route::post('carpetas/{carpeta}/asignar-usuario', [CarpetaController::class, 'asignarUsuario']);
Route::post('perfil', [PerfilController::class, 'actualizar']);
Route::resource('notificaciones-contacto', NotificacionContactoController::class)->only(['index', 'update']);

// Imagenes privadas de comproantes de pago
Route::get('/private/comprobantes/{imagen}', [PrivateImagesDepositoTransaccionController::class, 'comprobantes']);

// Creación de storage:link en hosting compartido
Route::get('storage-link', CrearStorageLinkController::class);
