<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cargos')->insert([
            'cargo' => 'Estudiante',
            'descripcion' => 'Tu Como Estudiante del Plantel, Puedes ser Evaluado Por tus Maestros y Tutores, e Interactuar Con Ellos.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('cargos')->insert([
            'cargo' => 'Profesor',
            'descripcion' => 'Tu Como Profesor del Plantel, Puedes Evaluar a tus Alumnos, Crear Salas para Tus Alumnos, e Interactuar Con Ellos.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('cargos')->insert([
            'cargo' => 'Foraneo',
            'descripcion' => 'Tu Como Foraneo del Plantel, Puedes Evaluar a Alumnos, Crear Salas para Tus Alumnos, e Interactuar Con Ellos Por un Tiempo Hasta Que lo Decida el Plantel.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
