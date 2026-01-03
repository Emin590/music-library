@extends('layout')
@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MusicLib</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-900 text-white font-sans antialiased min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-500 tracking-tight mb-2">Welcome Back</h1>
            <p class="text-zinc-400 text-sm">Log in to access your library.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <div class="mb-6">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <button type="submit" 
                class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-4 rounded transition transform hover:scale-105">
                Log In
            </button>

            <div class="mt-6 text-center">
                <p class="text-sm text-zinc-500">Don't have an account? <a href="/register" class="text-green-500 hover:underline">Register</a></p>
            </div>
        </form>
    </div>

</body>
</html>
@endsection