<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSala extends Model
{
    use HasFactory;

    protected $fillable = [
        "profesor",
        "user_id",
        "sala_id"
    ];

    public function user()  
    {
        return $this->belongsTo(User::class);
    }
}
