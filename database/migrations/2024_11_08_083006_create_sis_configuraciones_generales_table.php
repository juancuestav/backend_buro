<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sis_configuraciones_generales', function (Blueprint $table) {
            $table->id();

            $table->text('logo_claro')->nullable();
            $table->text('logo_oscuro')->nullable();
            $table->text('logo_marca_agua')->nullable();
            $table->string('ruc');
            $table->string('representante')->nullable();
            $table->text('razon_social')->nullable();
            $table->text('nombre_comercial')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->text('direccion_principal')->nullable();
            $table->text('telefono')->nullable();
            $table->string('moneda')->default('$');
            $table->string('tipo_contribuyente')->nullable();
            $table->text('celular1')->nullable();
            $table->text('celular2')->nullable();
            $table->string('correo_principal')->nullable();
            $table->string('correo_secundario')->nullable();
            $table->string('sitio_web')->nullable();
            $table->text('direccion_secundaria1')->nullable();
            $table->text('direccion_secundaria2')->nullable();
            $table->string('ciiu')->nullable();

            $table->string('porcentaje_iva')->nullable();
            $table->string('admite_pago_efectivo')->nullable();
            $table->string('admite_pago_tarjeta')->nullable();
            $table->string('admite_deposito_bancario')->nullable();
            $table->string('url_pago_tarjeta')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('entidad_financiera')->nullable();
            $table->string('propietario_cuenta')->nullable();
            $table->string('identificacion_propietario_cuenta')->nullable();
            $table->string('numero_contacto')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sis_configuraciones_generales');
    }
};
