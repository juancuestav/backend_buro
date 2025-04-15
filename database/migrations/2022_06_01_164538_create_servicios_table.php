<?php

use App\Models\Servicio;
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
		Schema::create('servicios', function (Blueprint $table) {
			$table->id();

			$table->string('nombre')->unique();
			$table->text('descripcion');
			$table->enum('estado', [Servicio::BORRADOR, Servicio::ACTIVO])->default(Servicio::BORRADOR);
			$table->double('precio_unitario');
			$table->boolean('gravable')->default(true);
			$table->double('iva')->default(0);
			$table->boolean('es_plan')->default(false);
			$table->string('url_video')->nullable();
			$table->string('url_destino')->nullable(); // pago por payphone
            $table->string('url_paypal')->nullable();

			$table->unsignedBigInteger('categoria')->nullable();
			$table->foreign('categoria')->references('id')->on('categorias')->onDelete('set null')->onUpdate('cascade');

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
		Schema::dropIfExists('servicios');
	}
};
