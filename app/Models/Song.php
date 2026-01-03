<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- THIS LINE WAS MISSING
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    // This allows us to mass-assign data (like we did in the Create Route)
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}