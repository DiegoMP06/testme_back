<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'titulo',
        'instruccion',
        'max',
        'min',
        'test_version_id',
    ];

    public function testVersion()
    {
        return $this->belongsTo(TestVersion::class);
    }
}
