<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    // Use this instead of $guarded
    protected $fillable = ['title', 'artist', 'duration', 'album_cover', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
