<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sis_configuraciones_generales', function (Blueprint $table) {
            $table->string('mensaje_whatsapp')->nullable()->after('whatsapp');
            $table->string('whatsapp_soluciones_empresas')->nullable()->after('mensaje_whatsapp');
            $table->string('mensaje_whatsapp_soluciones_empresas')->nullable()->after('whatsapp_soluciones_empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sis_configuraciones_generales', function (Blueprint $table) {
            $table->dropColumn('mensaje_whatsapp');
            $table->dropColumn('whatsapp_soluciones_empresas');
            $table->dropColumn('mensaje_whatsapp_soluciones_empresas');
        });
    }
};
