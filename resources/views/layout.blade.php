<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Dark Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #18181b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #52525b; }
    </style>
</head>
<body class="bg-zinc-900 text-white font-sans antialiased h-screen flex overflow-hidden">

    <aside class="w-64 bg-black flex-shrink-0 flex flex-col border-r border-zinc-800">
        
        <div class="p-6">
            <a href="/">
                <h1 class="text-2xl font-bold text-green-500 tracking-tight">MusicLib</h1>
            </a>
            
        </div>

        <nav class="flex-1 px-4 space-y-2">
            
            <a href="/" class="flex items-center px-4 py-3 rounded-md transition {{ request()->is('/') ? 'bg-zinc-800 text-white' : 'text-zinc-400 hover:text-white hover:bg-zinc-900' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                My Songs
            </a>

        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto relative justify-center items-center flex flex-col">

        @yield('content')

    </main>

</body>
</html>