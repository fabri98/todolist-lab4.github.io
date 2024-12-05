<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablerosTable extends Migration
{
    public function up()
    {
        Schema::create('tableros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->text('descripcion')->nullable(); // Asegúrate de que esta línea esté presente
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tableros');
    }
}

