<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            'nombre' => 'Educacion',
            'imagen' => 'educacion.png',
            'descripcion' => 'Tests Ideales Para Temas de Educacion o Relacionados a la Escuela.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Negocios',
            'imagen' => 'negocios.png',
            'descripcion' => 'Tests Ideales Para Temas de Negocios o Para Poner a Prueba tu Conocimiento en Negocios.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Tecnologia',
            'imagen' => 'tecnologia.png',
            'descripcion' => 'Tests Ideales Para Temas de Tecnologia o Para Poner a Prueba Tu Conocimiento en Tecnologia.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Musica',
            'imagen' => 'musica.png',
            'descripcion' => 'Tests Ideales Para Temas de Musica o Para Poner a Prueba Tu Conocimiento Sobre la Musica.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Social',
            'imagen' => 'social.png',
            'descripcion' => 'Tests Ideales Para Temas Sociales o Para Poner a Prueba Tu Conocimiento Sobre La Sociedad.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Ciencias',
            'imagen' => 'ciencias.png',
            'descripcion' => 'Tests Ideales Para Temas de Ciencias o Para Poner a Prueba Tu Conocimiento Sobre las Ciencias.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Salud',
            'imagen' => 'salud.png',
            'descripcion' => 'Tests Ideales Para Temas de tu Salud o Para Poner a Prueba Tu Conocimiento en la Ciencia de la Salud.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Examen',
            'imagen' => 'examen.png',
            'descripcion' => 'Preparate Para Una Prueba, Confia en ti y Piensa Bien Las Cosas. Suerte...',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
