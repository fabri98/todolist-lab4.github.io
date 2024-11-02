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
    DB::statement("ALTER TABLE tareas MODIFY estado ENUM('pendiente', 'completada', 'en_progreso') DEFAULT 'pendiente'");
}

    

    /**
     * Reverse the migrations.
     */
    public function down()
{
    DB::statement("ALTER TABLE tareas MODIFY estado INT");
}

};
