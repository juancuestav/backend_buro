<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionGeneralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo_claro' => 'nullable|string',
            'logo_oscuro' => 'nullable|string',
            'logo_marca_agua' => 'nullable|string',
            'ruc' => 'required|string',
            'representante' => 'required|string',
            'razon_social' => 'required|string',
            'nombre_comercial' => 'required|string',
            'nombre_empresa' => 'required|string',
            'direccion_principal' => 'nullable|string',
            'telefono' => 'nullable|string',
            'moneda' => 'nullable|string',
            'tipo_contribuyente' => 'required|string',
            'celular1' => 'nullable|string',
            'celular2' => 'nullable|string',
            'correo_principal' => 'nullable|string',
            'correo_secundario' => 'nullable|string',
            'sitio_web' => 'nullable|string',
            'direccion_secundaria1' => 'nullable|string',
            'direccion_secundaria2' => 'nullable|string',
            'ciiu' => 'nullable|string',
            'porcentaje_iva' => 'nullable|string',
            'admite_pago_efectivo' => 'nullable|string',
            'admite_pago_tarjeta' => 'nullable|string',
            'admite_deposito_bancario' => 'nullable|string',
            'url_pago_tarjeta' => 'nullable|string',
            'numero_cuenta' => 'nullable|string',
            'entidad_financiera' => 'nullable|string',
            'propietario_cuenta' => 'nullable|string',
            'identificacion_propietario_cuenta' => 'nullable|string',
            'numero_contacto' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
        ];
    }
}
