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
		Schema::create('carpetas', function (Blueprint $table) {
			$table->id();
			$table->string('nombre');

			$table->unsignedBigInteger('id_carpeta_padre')->nullable();
			$table->foreign('id_carpeta_padre')->references('id')->on('carpetas')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedBigInteger('usuario')->nullable();
			$table->foreign('usuario')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
		Schema::dropIfExists('carpetas');
	}
};
