<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestVersion extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'nombre',
        'descripcion',
        'respuestas',
        'publico',
        'version',
        'test_id',
        'categoria_id',
        'tipo_id',
    ];

    public function existeVisita() 
    {
        return $this->visitas->contains('user_id', auth()->user()->id);
    }

    public function estaEnlazado($sala_id) 
    {
        return $this->testSalas->contains('sala_id', $sala_id);
    }
 
    public function test() 
    {
        return $this->belongsTo(Test::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class)->select(['id', 'nombre as categoria', 'imagen', 'descripcion']);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class)->select(['id', 'nombre as tipo', 'descripcion']);
    }

    public function instructions() 
    {
        return $this->hasMany(Instruction::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function visitas() 
    {
        return $this->hasMany(Visita::class);
    }

    public function testSalas()
    {
        return $this->hasMany(TestSala::class);
    }
}
