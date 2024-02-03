<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos')->insert([
            'nombre' => 'Basico',
            'descripcion' => 'Podras Crear Preguntas Con Las Mismas Opciones.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipos')->insert([
            'nombre' => 'Medio',
            'descripcion' => 'Prodras Crear Preguntas Con Diferentes Opciones.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipos')->insert([
            'nombre' => 'Avanzado',
            'descripcion' => 'Prodras Crear Preguntas Con Diferentes Opciones, y Podras Habilitar La Opcion Multiple.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipos')->insert([
            'nombre' => 'Examen',
            'descripcion' => 'Recomendado Para Examenes, Optimizando La Puntuacion.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}