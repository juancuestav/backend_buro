<?php

use App\Models\Pedido;
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
		Schema::create('pedidos', function (Blueprint $table) {
			$table->id();
			$table->string('numero_orden')->nullable();
			$table->date('fecha_emision')->nullable();
			$table->enum('estado_pago', [Pedido::PAGO_PENDIENTE, Pedido::PAGADO, Pedido::ANULADO])->default(Pedido::PAGO_PENDIENTE);
			$table->float('subtotal')->default(0);
			$table->float('total')->default(0);
			$table->float('pago_cliente')->default(0);
			$table->float('iva')->default(0);
			$table->enum('metodo_pago', [Pedido::EFECTIVO, Pedido::DEPOSITO, Pedido::TARJETA])->nullable();
			$table->text('comentario')->nullable();

            // Preguntas
            $table->string('tiene_reporte', 6)->nullable();
            $table->string('conoce_puntaje', 6)->nullable();
            $table->string('tiene_deudas', 6)->nullable();
            $table->string('es_cliente', 6)->nullable();

			$table->unsignedBigInteger('servicio');
			$table->foreign('servicio')->references('id')->on('servicios')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedBigInteger('marketing')->nullable();
			$table->foreign('marketing')->references('id')->on('marketings')->onDelete('cascade')->onUpdate('cascade');

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
		Schema::dropIfExists('pedidos');
	}
};
