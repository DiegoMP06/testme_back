<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaSala extends Model
{
    use HasFactory;

    protected $fillable = [
        'puntuacion',
        'total',
        'test_sala_id',
        'user_id',
    ];

    public function puedeVerRespuestas() 
    {
        return $this->testSala->testVersion->respuestas;
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function testSala()
    {
        return $this->belongsTo(TestSala::class);
    }

    public function respuestaVisitaSalas() 
    {
        return $this->hasMany(RespuestaVisitaSala::class);
    }
}
