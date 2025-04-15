<?php

namespace App\Models;

use App\Models\Admin\UserProfile;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableModel;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

/**
 * @method static where(string $string, false $false)
 * @method static whereNotIn(string $string, $ids_users_inactivos)
 * @method static find(mixed $empleado_id)
 */
class User extends Authenticatable implements Auditable // implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, AuditableModel, HasRoles, Searchable, Filterable;

    // Empresas
    const APP_ID_BURO_CREDITO_ECUADOR = '1';
    const APP_ID_TRABAJOS_ECUADOR = '2';

    // Roles
    const ROL_EMPLEADO = 'EMPLEADO';
    const ROL_ADMINISTRADOR = 'ADMINISTRADOR';
    const ROL_SUPER_ADMINISTRADOR = 'SUPERADMINISTRADOR';
    const ROL_CLIENTE = 'CLIENTE';
    const ROL_EMPRESA = 'EMPRESA';

    // Tipos de identificacion
    const CEDULA = 'CEDULA';
    const RUC = 'RUC';
    const PASAPORTE = 'PASAPORTE';

    const SUBIDA_ARCHIVOS_PENDIENTE = 'SUBIDA DE ARCHIVOS PENDIENTE';
    const EN_ESPERA_VERIFICACION = 'EN ESPERA DE VERIFICACION';
    const VERIFICADO = 'VERIFICADO';
    const NO_CUMPLE = 'USTED NO CUMPLE CON LOS PARAMETROS INTEGRALES ESTABLECIDOS POR TRABAJOS ECUADOR PARA PARTICIPAR DENTRO DEL PROCESO DE RECLUTAMIENTO';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellidos',
        'celular',
        'tipo_identificacion',
        'identificacion',
        'direccion',
        'edad',
        'codigo_reclutador',
    ];

    private static $whiteListFilter = ['*'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tipo_identificacion' => 'int'
    ];

    public function toSearchableArray()
    {
        return [
            'identificacion' => $this['identificacion'],
            'name' => $this['name'],
            'apellidos' => $this['apellidos'],
        ];
    }

    // Relacion de uno a muchos
    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'usuario');
    }

    public function facturacionPlanes()
    {
        return $this->hasMany(FacturacionPlan::class, 'user_id');
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function consultasRealizadas()
    {
        // Realizar la consulta que cuenta el total de consultas por usuario
        return DB::table('auditoria_tablas_precalificacion')
            ->where('user_id', $this->id)
            ->count();
    }

    public static function getFullname()
    {
        $user = Auth::user();
        return $user->name . ' ' . ($user->apellidos ?? '');
    }

    public static function rolesUsuarioActual(): array
    {
        $usuario = User::find(Auth::id());
        return $usuario->getRoleNames()->toArray();
    }

    // Permite a vue acceder a los roles y permisos
    public function getAllPermissionsAttribute()
    {
        $permissions = [];
        $user = User::find(Auth::id());

        foreach (Permission::all() as $permission) {
            if ($user->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }

    public function obtenerPermisos($user_id)
    {
        $user = User::find($user_id);
        $es_superadministrador = $user->hasRole(self::ROL_SUPER_ADMINISTRADOR);
        return $es_superadministrador ? Permission::all()->pluck('name') : $user->getPermissionsViaRoles()->pluck('name');
    }

    public function hasTokenPermission($ability)
    {
        //return Auth::user()->hasPermissionTo($ability);
        return true;
    }

    public static function extraerNombresApellidos(User $usuario)
    {
        return $usuario->name . ' ' . $usuario->apellidos;
    }
}
