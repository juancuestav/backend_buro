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
		Schema::create('popups', function (Blueprint $table) {
			$table->id();
			$table->string('titulo');
			$table->text('descripcion')->nullable();
			$table->string('url_destino')->nullable();
			$table->boolean('nueva_pestana')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('popups');
	}
};
