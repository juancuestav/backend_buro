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
        Schema::create('mejoramientos', function (Blueprint $table) {
            $table->id();
            $table->integer('puntaje_actual');
            $table->string('deudas_vencidas');
            $table->integer('puntaje_subir');
            $table->integer('maximo_subir')->nullable();
            $table->string('observacion')->nullable();
            $table->string('estado')->default('PENDIENTE')->nullable();

            $table->unsignedBigInteger('usuario');
			$table->foreign('usuario')->references('id')->on('users')->onDeleted('cascade')->onUpdated('cascade');

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
        Schema::dropIfExists('mejoramientos');
    }
};
