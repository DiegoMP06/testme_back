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

    public function numProfesores() 
    {
        return $this->userSalas()->where('profesor', 1)->count();
    }

    public function numAlumnos() 
    {
        return $this->userSalas()->where('profesor', 0)->count();
    }

    public function existeEnlace() {
        return $this->userSalas->contains('user_id', auth()->user()->id);
    }

    public function esProfesor() 
    {
        return $this->userSalas()
            ->where('user_id', auth()->user()->id)
            ->where('profesor', 1)
            ->get()->count() > 0 || auth()->user()->salas->contains('id', $this->id);
    }

    public function testEnlazado($test_id) 
    {
        return $this->testSalas->contains('test_version_id', $test_id);
    }

    public function userSalas() 
    {
        return $this->hasMany(UserSala::class);
    }

    public function testSalas()
    {
        return $this->hasMany(TestSala::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'user_salas')->withPivot(['id', 'profesor']);
    }

    public function tests() 
    {
        return $this->belongsToMany(TestVersion::class, 'test_salas')->withPivot(['id']);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}