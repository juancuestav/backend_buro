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
        Schema::create('admin_accesos_directos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('link');
            $table->longText('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('nueva_pestana')->default(false);
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
        Schema::dropIfExists('admin_accesos_directos');
    }
};
