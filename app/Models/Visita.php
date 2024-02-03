<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'puntuacion',
        'total',
        'test_version_id',
        'user_id',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function testVersion()
    {
        return $this->belongsTo(TestVersion::class);
    }

    public function respuestaVisitas() 
    {
        return $this->hasMany(RespuestaVisita::class);
    }
}
