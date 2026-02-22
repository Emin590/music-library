@extends('layout')

@section('title', 'Login - MusicLib')

@section('content')
<div class="flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-md bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-500 tracking-tight mb-2">Welcome Back</h1>
            <p class="text-zinc-400 text-sm">Log in to access your library.</p>
        </div>

        {{-- Display Server-side Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-3 rounded mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST" id="loginForm">
            @csrf

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <div class="mb-6">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password"
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
</div>

<script>
    // Client-side Validation (UX & Greenability)
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        if (!email.includes('@') || password.length < 1) {
            e.preventDefault(); // Stop server request
            alert('Please enter a valid email and password.');
        }
    });
</script>
@endsection