<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lista')->constrained()->onDelete('cascade'); // Referencia a la lista
            $table->string('titulo');
            $table->string('descripcion')->nullable(); // Permitir nulo si no es necesario
            $table->date('fecha_limite')->nullable(); // Permitir nulo si no es necesario
            $table->enum('estado', ['pendiente', 'completada', 'en_progreso'])->default('pendiente');
            $table->string('prioridad')->default('baja'); // Valor por defecto
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
