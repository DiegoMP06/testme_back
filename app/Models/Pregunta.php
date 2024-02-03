<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'pregunta',
        'type',
        'required',
        'campo_extra',
        'extras',
        'test_version_id',
    ];

    public function testVersion()
    {
        return $this->belongsTo(TestVersion::class);
    }
    
    public function options() {
        return $this->belongsToMany(Option::class, 'preguntas_options');
    }
}
