<?php

namespace App\Http\Resources\Sistema;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfiguracionGeneralResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'logo_claro' => $this['logo_claro'] ? url($this['logo_claro']) : null,
            'logo_oscuro' => $this['logo_oscuro'] ? url($this['logo_oscuro']) : null,
            'logo_marca_agua' => $this['logo_marca_agua'] ? url($this['logo_marca_agua']) : null,
            'ruc' => $this['ruc'],
            'ciiu' => $this['ciiu'],
            'representante' => $this['representante'],
            'razon_social' => $this['razon_social'],
            'nombre_comercial' => $this['nombre_comercial'],
            'direccion_principal' => $this['direccion_principal'],
            'telefono' => $this['telefono'],
            'moneda' => $this['moneda'],
            'tipo_contribuyente' => $this['tipo_contribuyente'],
            'celular1' => $this['celular1'],
            'celular2' => $this['celular2'],
            'correo_principal' => $this['correo_principal'],
            'correo_secundario' => $this['correo_secundario'],
            'sitio_web' => $this['sitio_web'],
            'direccion_secundaria1' => $this['direccion_secundaria1'],
            'direccion_secundaria2' => $this['direccion_secundaria2'],
            'nombre_empresa' => $this['nombre_empresa'],
            'porcentaje_iva' => $this['porcentaje_iva'],
            'admite_pago_efectivo' => $this['admite_pago_efectivo'],
            'admite_pago_tarjeta' => $this['admite_pago_tarjeta'],
            'admite_deposito_bancario' => $this['admite_deposito_bancario'],
            'url_pago_tarjeta' => $this['url_pago_tarjeta'],
            'numero_cuenta' => $this['numero_cuenta'],
            'entidad_financiera' => $this['entidad_financiera'],
            'propietario_cuenta' => $this['propietario_cuenta'],
            'identificacion_propietario_cuenta' => $this['identificacion_propietario_cuenta'],
            'numero_contacto' => $this['numero_contacto'],
            'whatsapp' => $this['whatsapp'],
            'mensaje_whatsapp' => $this['mensaje_whatsapp'],
            'whatsapp_soluciones_empresas' => $this['whatsapp_soluciones_empresas'],
            'mensaje_whatsapp_soluciones_empresas' => $this['mensaje_whatsapp_soluciones_empresas'],
            'facebook' => $this['facebook'],
            'instagram' => $this['instagram'],
            'twitter' => $this['twitter'],
        ];
    }
}
