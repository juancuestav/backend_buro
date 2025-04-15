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
        Schema::create('usu_verificar_cuentas', function (Blueprint $table) {
            $table->id();

            $table->text('documento_identidad_anverso');
            $table->text('documento_identidad_reverso');
            $table->text('documento_identidad_selfie');

            // Foreign keys
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('usu_verificar_cuentas');
    }
};
