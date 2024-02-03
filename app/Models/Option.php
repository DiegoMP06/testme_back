<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'opcion',
        'valor',
        'test_version_id',
    ];

    public function testVersion()
    {
        return $this->belongsTo(TestVersion::class);
    }
}
