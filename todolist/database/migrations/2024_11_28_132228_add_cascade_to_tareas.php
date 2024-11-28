<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign(['id_lista']);
            $table->foreign('id_lista')->references('id')->on('listas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign(['id_lista']);
            $table->foreign('id_lista')->references('id')->on('listas');
        });
    }

};
