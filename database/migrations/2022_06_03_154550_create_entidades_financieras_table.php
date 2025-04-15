<?php

use App\Models\EntidadFinanciera;
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
		Schema::create('entidades_financieras', function (Blueprint $table) {
			$table->id();

			$table->string('nombre');
			$table->enum('tipo', [EntidadFinanciera::BANCO, EntidadFinanciera::COOPERATIVA, EntidadFinanciera::CAJA_DE_AHORRO])->nullable();

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
		Schema::dropIfExists('entidades_financieras');
	}
};
