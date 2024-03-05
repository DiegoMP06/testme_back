<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido_paterno',
        'apellido_materno',
        'usuario',
        'telefono',
        'biografia',
        'imagen',
        'perfil',
        'admin',
        'cargo_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function estaEnlazado($sala_id) {
        return $this->userSalas->contains('sala_id', $sala_id) || $this->salas->contains('id', $sala_id);
    }

    public function cargo() 
    {
        return $this->belongsTo(Cargo::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function visitas() {
        return $this->hasMany(Visita::class);
    }

    public function visitaSalas() {
        return $this->hasMany(VisitaSala::class);
    }

    public function salas() 
    {
        return $this->hasMany(Sala::class);
    }

    public function enlaceSalas() 
    {
        return $this->belongsToMany(Sala::class, 'user_salas')->withPivot(['id', 'profesor']);
    }

    public function userSalas() 
    {
        return $this->hasMany(UserSala::class);
    }
}
