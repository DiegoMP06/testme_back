<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudSala extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "sala_id",
    ];

    public function sala() 
    {
        return $this->belongsTo(Sala::class)->select(['id', 'nombre', 'descripcion', 'num_alumnos', 'num_profesores']);
    }
}
