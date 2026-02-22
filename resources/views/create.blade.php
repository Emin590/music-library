@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-lg bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        <h1 class="text-3xl font-bold text-green-500 mb-6">Add New Song</h1>

        {{-- Added an ID to the form for JavaScript to grab --}}
        <form action="{{ route('songs.store') }}" method="POST" id="songForm">
            @csrf 

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="title">Song Title</label>
                {{-- old('title') keeps the value if the server returns an error --}}
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500"
                    placeholder="e.g. Blinding Lights">
                
                {{-- Server-side error message --}}
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="artist">Artist Name</label>
                <input type="text" name="artist" id="artist" value="{{ old('artist') }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500"
                    placeholder="e.g. The Weeknd">
                
                @error('artist')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 mb-6">
                <div class="w-1/3">
                    <label class="block text-zinc-400 text-sm font-bold mb-2">Duration</label>
                    <input type="text" name="duration" id="duration" value="{{ old('duration') }}"
                        class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500"
                        placeholder="3:45">
                </div>
                
                <div class="w-2/3">
                    <label class="block text-zinc-400 text-sm font-bold mb-2">Cover URL</label>
                    <input type="url" name="album_cover" id="album_cover" value="{{ old('album_cover') }}"
                        class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500"
                        placeholder="https://...">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="/" class="text-zinc-400 hover:text-white transition">Cancel</a>
                <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-6 rounded-full transition transform hover:scale-105">
                    Save Song
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Client-Side JavaScript Validation --}}
<script>
    document.getElementById('songForm').addEventListener('submit', function(event) {
        let title = document.getElementById('title').value;
        let artist = document.getElementById('artist').value;

        // Basic check: prevent submission if fields are too short
        if (title.trim().length < 2) {
            event.preventDefault(); // This stops the form from sending!
            alert('Please enter a valid song title (at least 2 characters).');
            return;
        }

        if (artist.trim().length < 2) {
            event.preventDefault();
            alert('Please enter a valid artist name.');
            return;
        }
    });
</script>
@endsection