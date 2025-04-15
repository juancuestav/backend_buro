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
        Schema::create('rep_archivo_reportes', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');

            // Foreign keys
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('subido_por_user_id');
            $table->foreign('subido_por_user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('reporte_id');
            $table->foreign('reporte_id')->references('id')->on('reportes')->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('rep_archivo_reportes');
    }
};
