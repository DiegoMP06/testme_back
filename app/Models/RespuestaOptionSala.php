<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaOptionSala extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_id',
        'respuesta_visita_sala_id',
    ];
}
