@extends('layout')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MusicLib</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-900 text-white font-sans antialiased min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-black p-8 rounded-lg shadow-2xl border border-zinc-800">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-500 tracking-tight mb-2">Join MusicLib</h1>
            <p class="text-zinc-400 text-sm">Create an account to manage your library.</p>
        </div>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- The Form -->
        <form action="/register" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="name">Full Name</label>
                <input type="text" name="name" id="name" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="email">Email Address</label>
                <input type="email" name="email" id="email" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-zinc-400 text-sm font-bold mb-2" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full bg-zinc-800 text-white border border-zinc-700 rounded py-3 px-4 focus:outline-none focus:border-green-500 transition">
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-4 rounded transition transform hover:scale-105">
                Create Account
            </button>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-zinc-500">Already have an account? <a href="/login" class="text-green-500 hover:underline">Log in</a></p>
            </div>
        </form>
    </div>

</body>
</html>
@endsection