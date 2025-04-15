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
        Schema::create('facturacion_planes', function (Blueprint $table) {
            $table->id();
			$table->boolean('pagado')->default(false);
			$table->string('fecha_pago')->nullable();
			$table->string('proximo_pago')->nullable(); // como date no funcionan las operaciones de fecha

            $table->unsignedBigInteger('usuario');
			$table->foreign('usuario')->references('id')->on('users')->onDeleted('cascade')->onUpdated('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturacion_planes');
    }
};
