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
		Schema::create('lineas_pedido', function (Blueprint $table) {
			$table->id();

			$table->float('precio');

			$table->unsignedBigInteger('pedido');
			$table->foreign('pedido')->references('id')->on('pedidos')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedBigInteger('servicio')->nullable();
			$table->foreign('servicio')->references('id')->on('servicios')->onDelete('set null')->onUpdate('cascade');

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
		Schema::dropIfExists('lineas_pedido');
	}
};
