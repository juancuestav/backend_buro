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
        Schema::table('admin_user_profiles', function (Blueprint $table) {
            $table->foreignId('provincia_id')
                ->nullable() // Permitir valores NULL
                ->constrained('provincias')
                ->onDelete('cascade')
                ->after('user_id');

            $table->foreignId('canton_id')
                ->nullable() // Permitir valores NULL
                ->constrained('ciudades')
                ->onDelete('cascade')
                ->after('provincia_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_user_profiles', function (Blueprint $table) {
            $table->dropForeign(['provincia_id']);
            $table->dropForeign(['canton_id']);
            $table->dropColumn('provincia_id');
            $table->dropColumn('canton_id');
        });
    }
};
