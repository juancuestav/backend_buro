<?php

use App\Models\DepositoTransferencia;
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
        Schema::create('depositos_transferencias', function (Blueprint $table) {
            $table->id();

			$table->text('motivo');
			$table->boolean('es_deposito');
			$table->double('monto');
			$table->string('comprobante', 100);
			$table->date('fecha_transaccion');
			$table->enum('tipo_transferencia', [DepositoTransferencia::TRASPASO, DepositoTransferencia::TRANSFERENCIA])->nullable();

			$table->unsignedBigInteger('pedido')->nullable();
			$table->foreign('pedido')->references('id')->on('pedidos')->onDelete('set null')->onUpdate('cascade');

			$table->unsignedBigInteger('cuenta')->nullable();
			$table->foreign('cuenta')->references('id')->on('entidades_financieras')->onDelete('set null')->onUpdate('cascade');
			
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
        Schema::dropIfExists('depositos_transferencias');
    }
};
