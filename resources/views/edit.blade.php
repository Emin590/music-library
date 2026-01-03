@extends('layout')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-900 text-white font-sans antialiased flex items-center justify-center min-h-screen">

    <div class="w-full max-w-lg bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        <h1 class="text-3xl font-bold text-blue-500 mb-6">Edit Song</h1>

        <form action="/{{ $song->id }}/update" method="POST">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $song->title }}" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="artist">Artist</label>
                <input type="text" name="artist" id="artist" value="{{ $song->artist }}" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex gap-4 mb-6">
                <div class="w-1/3">
                    <label class="block text-zinc-400 text-sm font-bold mb-2" for="duration">Duration</label>
                    <input type="text" name="duration" id="duration" value="{{ $song->duration }}"
                        class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="w-2/3">
                    <label class="block text-zinc-400 text-sm font-bold mb-2" for="album_cover">Cover URL</label>
                    <input type="url" name="album_cover" id="album_cover" value="{{ $song->album_cover }}"
                        class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-blue-500">
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

</body>
</html>
@endsection