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
		Schema::create('reportes', function (Blueprint $table) {
			$table->id();
			$table->json('reporte');
			
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
		Schema::dropIfExists('reportes');
	}
};
