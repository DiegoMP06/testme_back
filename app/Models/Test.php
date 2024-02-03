<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'ultima_version',
        'user_id',
    ];

    public function testVersions() 
    {
        return $this->hasMany(TestVersion::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class)->select(['id', "name", 'apellido_paterno', "apellido_materno", 'usuario', 'imagen']);
    }
}
