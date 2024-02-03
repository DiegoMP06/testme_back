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
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('usuario')->unique();
            $table->string('telefono')->nullable();
            $table->longText('biografia')->nullable();
            $table->string('imagen')->nullable();
            $table->json('perfil');
            $table->boolean('admin')->default(0);

            // {"email":false,"created_at":false,"telefono":false,"biografia":false,"rol":true}
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'apellido_paterno',
                'apellido_materno',
                'usuario',
                'telefono',
                'biografia',
                'imagen',
                'perfil',
                'admin',
            ]);
        });
    }
};
