<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaVisita extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'visita_id',
        'pregunta_id'
    ];

    public function options() 
    {
        return $this->belongsToMany(Option::class, 'respuesta_opcions');
    }
    
    public function pregunta() 
    {
        return $this->belongsTo(Pregunta::class);
    }
}
