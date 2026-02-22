@extends('layout')

@section('content')
<main class="flex-1 flex flex-col min-w-0 overflow-hidden">
    <header class="bg-zinc-900 border-b border-zinc-800 p-4 flex justify-end items-center gap-4">
        @auth
            {{-- UPDATED: Using the Named Route here --}}
            <a href="{{ route('songs.create') }}">
                <button class="bg-green-500 hover:bg-green-600 text-black font-bold py-2 px-4 rounded-full transition transform hover:scale-105">
                    + Add Song
                </button>
            </a>
            
            <div class="flex items-center gap-4 border-l border-zinc-800 pl-4">
                <span class="text-white font-bold">Hi, {{ auth()->user()->name }}</span>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-zinc-400 hover:text-white">Log Out</button>
                </form>
            </div>
        @endauth

        @guest
            <a href="/register" class="bg-white text-black font-bold py-2 px-4 rounded-full transition">Register</a>
            <a href="/login" class="bg-white text-black font-bold py-2 px-4 rounded-full transition">Login</a>
        @endguest
    </header>

    <div class="flex-1 overflow-y-auto p-8">
        @if(session('success'))
            <div class="bg-green-500 text-black p-4 rounded-lg mb-6 shadow-lg flex items-center justify-between">
                <span class="font-bold">{{ session('success') }}</span>
                <span onclick="this.parentElement.style.display='none'" class="cursor-pointer text-xl font-bold">&times;</span>
            </div>
        @endif

        <h3 class="text-2xl font-bold mb-6">Your Songs</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($songs as $song)
            <div class="bg-zinc-800 p-4 rounded-lg hover:bg-zinc-700 transition group relative">
                <div class="relative aspect-square mb-4 bg-black rounded-md overflow-hidden shadow-lg">
                    <img src="{{ $song->album_cover ?? 'https://placehold.co/300x300' }}" 
                         alt="Album Art" 
                         loading="lazy"
                         decoding="async" {{-- Added for Greenability (Async CPU decoding) --}}
                         class="object-cover w-full h-full">
                </div>
                
                <h4 class="font-bold truncate text-white">{{ $song->title }}</h4>
                <p class="text-sm text-zinc-400 truncate mb-4">{{ $song->artist }}</p>

                <div class="flex justify-end items-center gap-3 border-t border-zinc-600 pt-3 mt-2">
                    {{-- Update this part in your @foreach loop --}}
                    <a href="/{{ $song->id }}" class="text-zinc-400 hover:text-white" title="View Details">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>

                    <a href="/{{ $song->id }}/edit" class="text-blue-400 hover:text-blue-300" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </a>

                    <form action="/{{ $song->id }}" method="POST" onsubmit="return confirm('Delete this song forever?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-400" title="Delete">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer class="h-16 bg-zinc-900 border-t border-zinc-800 px-6 flex items-center justify-between">
        <div class="text-zinc-400 text-sm">
            <span class="text-green-500 font-bold">{{ count($songs) }}</span> Songs in Library
        </div>
        <div class="text-zinc-600 text-xs uppercase tracking-widest font-semibold">
            MusicLib &copy; 2026
        </div>
        <div class="flex items-center gap-2">
            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
            <span class="text-green-500 text-xs font-bold">ONLINE</span>
        </div>
    </footer>
</main>
@endsection