<?php

namespace App\Models\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableModel;

class ConfiguracionGeneral extends Model implements Auditable
{
    use HasFactory, AuditableModel;

    protected $table = 'sis_configuraciones_generales';
    protected $fillable = [
        'logo_claro',
        'logo_oscuro',
        'logo_marca_agua',
        'ruc',
        'representante',
        'razon_social',
        'nombre_comercial',
        'nombre_empresa',
        'direccion_principal',
        'telefono',
        'moneda',
        'tipo_contribuyente',
        'celular1',
        'celular2',
        'correo_principal',
        'correo_secundario',
        'sitio_web',
        'direccion_secundaria1',
        'direccion_secundaria2',
        'ciiu',
        'porcentaje_iva',
        'admite_pago_efectivo',
        'admite_pago_tarjeta',
        'admite_deposito_bancario',
        'url_pago_tarjeta',
        'numero_cuenta',
        'entidad_financiera',
        'propietario_cuenta',
        'identificacion_propietario_cuenta',
        'numero_contacto',
        'whatsapp',
        'mensaje_whatsapp',
        'whatsapp_soluciones_empresas',
        'mensaje_whatsapp_soluciones_empresas',
        'facebook',
        'instagram',
        'twitter',
    ];
}
