<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'num_alumnos',
        'num_profesores',
        'password',
        'publico',
        'acceso',
        'user_id',
    ];

    public function existeEnlace() {
        return $this->userSalas->contains('user_id', auth()->user()->id);
    }

    public function userSalas() 
    {
        return $this->hasMany(UserSala::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_salas');
    }

    public function user() 
    {
        return $this->belongsTo(User::class)->select(['id', "name", 'apellido_paterno', "apellido_materno", 'usuario', 'imagen']);
    }
}