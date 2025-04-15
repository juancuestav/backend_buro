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
        Schema::create('admin_personas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('apellidos_nombres');
            $table->foreignId('sexo_id')->constrained('admin_sexos')->onDelete('cascade');
            $table->foreignId('condicion_id')->constrained('admin_condiciones_civiles')->onDelete('cascade');
            $table->date('fecha_nacimiento');
            $table->foreignId('pais_id')->constrained('admin_paises')->onDelete('cascade');
            $table->foreignId('estado_civil_id')->constrained('admin_estados_civiles')->onDelete('cascade');
            $table->string('conyugue');
            $table->string('cedula_conyugue');
            $table->string('apellidos_nombres_padre');
            $table->foreignId('pais_padre_id')->constrained('admin_paises')->onDelete('cascade');
            $table->string('cedula_padre');
            $table->string('apellidos_nombres_madre');
            $table->foreignId('pais_madre_id')->constrained('admin_paises')->onDelete('cascade');
            $table->string('cedula_madre');
            $table->string('direccion');
            $table->date('fecha_matrimonio')->nullable();
            $table->foreignId('puesto_ocupacion_id')->constrained('admin_puestos_ocupaciones_civiles')->onDelete('cascade');
            $table->date('fecha_emision')->nullable();
            $table->string('codigo_dactilar')->nullable();
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
        Schema::dropIfExists('admin_personas');
    }
};
