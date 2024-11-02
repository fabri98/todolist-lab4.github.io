<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tableros', function (Blueprint $table) {
        $table->text('descripcion')->nullable(); // Agrega la columna
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tableros', function (Blueprint $table) {
            $table->dropColumn('descripcion'); // Elimina la columna si es necesario
        });
    }
};
