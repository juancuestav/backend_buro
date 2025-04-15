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
            $table->integer('limite_consultas')->default(0)->after('puntuacion');
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
            $table->dropColumn('limite_consultas');
        });
    }
};
