<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sis_notificaciones', function (Blueprint $table) {
            $table->id();

            $table->text('mensaje');
            $table->string('link')->nullable();
            $table->unsignedBigInteger('per_originador_id')->nullable();
            $table->unsignedBigInteger('per_destinatario_id')->nullable();
            $table->string('tipo_notificacion');
            $table->unsignedBigInteger('notificable_id');
            $table->string('notificable_type');
            $table->boolean('leida')->default(false);
            $table->boolean('informativa')->default(true);

            $table->foreign('per_originador_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('per_destinatario_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('sis_notificaciones');
    }
};
