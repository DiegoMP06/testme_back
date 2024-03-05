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
        Schema::create('visita_salas', function (Blueprint $table) {
            $table->id();
            $table->integer('puntuacion');
            $table->integer('total');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_sala_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visita_salas');
    }
};
