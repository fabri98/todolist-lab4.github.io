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
        Schema::table('tableros', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->nullable()->after('id'); // Cambia 'id' por el nombre del campo después del cual quieres agregar 'id_user'.
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tableros', function (Blueprint $table) {
            //
        });
    }
};
