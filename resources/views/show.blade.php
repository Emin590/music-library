@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-2xl bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/2 aspect-square rounded-lg overflow-hidden shadow-lg bg-zinc-900">
                <img src="{{ $song->album_cover ?? 'https://placehold.co/600x600' }}" 
                     alt="{{ $song->title }}" class="object-cover w-full h-full">
            </div>

            <div class="w-full md:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $song->title }}</h1>
                <p class="text-xl text-green-500 font-medium mb-6">{{ $song->artist }}</p>
                
                <div class="space-y-4 border-t border-zinc-800 pt-6">
                    <div>
                        <span class="text-zinc-500 text-sm uppercase tracking-widest">Duration</span>
                        <p class="text-white text-lg">{{ $song->duration ?? 'Unknown' }}</p>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="/" class="px-6 py-2 bg-zinc-800 hover:bg-zinc-700 text-white rounded-full transition">
                        Back to Library
                    </a>
                    <a href="/{{ $song->id }}/edit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full transition">
                        Edit Song
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection