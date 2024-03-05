<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSala extends Model
{
    use HasFactory;

    protected $fillable = [
        "test_version_id",
        "sala_id",
    ];

    public function existeVisitaSala() 
    {
        return $this->visitaSalas->contains('user_id', auth()->user()->id);
    }

    public function esCreador() 
    {
        return $this->testVersion->test->user->id === auth()->user()->id || $this->sala->user_id === auth()->user()->id;
    }

    public function testVersion() 
    {
        return $this->belongsTo(TestVersion::class);
    }

    public function sala() 
    {
        return $this->belongsTo(Sala::class);
    }

    public function visitaSalas() 
    {
        return $this->hasMany(VisitaSala::class);
    }
}
