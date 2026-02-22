@extends('layout')

@section('title', 'Register - MusicLib')

@section('content')
<div class="flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-md bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-500 tracking-tight mb-2">Join MusicLib</h1>
            <p class="text-zinc-400 text-sm">Create an account to manage your library.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST" id="registerForm">
            @csrf

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="name">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <div class="mb-6">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <button type="submit" 
                class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-4 rounded transition transform hover:scale-105">
                Create Account
            </button>

            <div class="mt-6 text-center">
                <p class="text-sm text-zinc-500">Already have an account? <a href="/login" class="text-green-500 hover:underline">Log in</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const pass = document.getElementById('password').value;
        const conf = document.getElementById('password_confirmation').value;

        if (pass.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters.');
            return;
        }

        if (pass !== conf) {
            e.preventDefault();
            alert('Passwords do not match!');
        }
    });
</script>
@endsection