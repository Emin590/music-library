@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-lg bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        <h1 class="text-3xl font-bold text-blue-500 mb-6">Edit Song</h1>

        <form action="/{{ $song->id }}/update" method="POST" id="editSongForm">
            @csrf
            @method('PUT') 

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="title">Title</label>
                {{-- old('title', $song->title) defaults to the DB value if no fresh error exists --}}
                <input type="text" name="title" id="title" value="{{ old('title', $song->title) }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="artist">Artist</label>
                <input type="text" name="artist" id="artist" value="{{ old('artist', $song->artist) }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
                @error('artist') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-4 mb-6">
                <div class="w-1/3">
                    <label class="block text-zinc-400 text-sm font-bold mb-2" for="duration">Duration</label>
                    <input type="text" name="duration" id="duration" value="{{ old('duration', $song->duration) }}"
                        class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
                    @error('duration') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="w-2/3">
                    <label class="block text-zinc-400 text-sm font-bold mb-2" for="album_cover">Cover URL</label>
                    <input type="url" name="album_cover" id="album_cover" value="{{ old('album_cover', $song->album_cover) }}"
                        class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
                    @error('album_cover') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="/" class="text-zinc-400 hover:text-white transition">Cancel</a>
                <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full transition transform hover:scale-105">
                    Update Song
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Client-side Validation logic
    document.getElementById('editSongForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const artist = document.getElementById('artist').value.trim();

        if (title.length < 2 || artist.length < 2) {
            e.preventDefault(); // Stop the PUT request
            alert('Title and Artist must be at least 2 characters long.');
        }
    });
</script>
@endsection