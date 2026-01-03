<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Song::create([
            'title' => 'Midnight City',
            'artist' => 'M83',
            'duration' => '4:03',
            'album_cover' => 'https://placehold.co/300x300/1a1a1a/white?text=M83'
        ]);

        \App\Models\Song::create([
            'title' => 'Blinding Lights',
            'artist' => 'The Weeknd',
            'duration' => '3:20',
            'album_cover' => 'https://placehold.co/300x300/1a1a1a/white?text=Weeknd'
        ]);
        
        \App\Models\Song::create([
            'title' => 'Levitating',
            'artist' => 'Dua Lipa',
            'duration' => '3:23',
            'album_cover' => 'https://placehold.co/300x300/1a1a1a/white?text=Dua'
        ]);
    }
}
