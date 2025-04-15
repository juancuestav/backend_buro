<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('apellidos')->nullable();
            $table->string('celular', 10);
            $table->string('identificacion', 13)->unique();
            $table->integer('edad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('codigo_verificacion')->nullable();
            $table->boolean('conectado')->default(false);
            $table->timestamp('hora_conexion')->nullable();
            $table->enum('estado_verificacion', [User::SUBIDA_ARCHIVOS_PENDIENTE, User::EN_ESPERA_VERIFICACION, User::VERIFICADO, User::NO_CUMPLE])->default(User::SUBIDA_ARCHIVOS_PENDIENTE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
