@extends('layout')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $song->title }} - Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-900 text-white font-sans antialiased min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-4xl bg-black rounded-xl overflow-hidden shadow-2xl border border-zinc-800 flex flex-col md:flex-row">
        
        <div class="md:w-1/2 relative bg-zinc-800">
            <img src="{{ $song->album_cover ?? 'https://placehold.co/600x600' }}" 
                 alt="Album Cover" 
                 class="w-full h-full object-cover aspect-square">
        </div>

        <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
            
            <div class="uppercase tracking-wide text-sm text-green-500 font-semibold mb-2">Song Details</div>
            
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-2">{{ $song->title }}</h1>
            <p class="text-xl text-zinc-400 mb-6">{{ $song->artist }}</p>

            <div class="grid grid-cols-2 gap-4 mb-8 border-t border-b border-zinc-800 py-6">
                <div>
                    <span class="block text-zinc-500 text-xs uppercase tracking-wider">Duration</span>
                    <span class="text-lg">{{ $song->duration }}</span>
                </div>
                <div>
                    <span class="block text-zinc-500 text-xs uppercase tracking-wider">Added On</span>
                    <span class="text-lg">{{ $song->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <div class="flex gap-4">
                <a href="/" class="flex-1 bg-zinc-800 hover:bg-zinc-700 text-white text-center font-bold py-3 px-4 rounded-full transition">
                    &larr; Back
                </a>
                
                <a href="/{{ $song->id }}/edit" class="flex-1 bg-green-500 hover:bg-green-600 text-black text-center font-bold py-3 px-4 rounded-full transition">
                    Edit Song
                </a>
            </div>

        </div>
    </div>

</body>
</html>
@endsection