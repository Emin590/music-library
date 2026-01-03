<?php

use Illuminate\Support\Facades\Route;
use App\Models\Song;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// ==========================================
// 1. PUBLIC ROUTES (Accessible by everyone)
// ==========================================

Route::get('/', function () {
    // If user is logged in, show THEIR songs
    if (Auth::check()) {
        // Fetch songs ONLY where user_id matches the logged in user
        $songs = Auth::user()->songs()->latest()->get();
    } else {
        // If guest, show nothing (or you could show public songs)
        $songs = [];
    }

    return view('index', ['songs' => $songs]);
});

// ==========================================
// 2. GUEST ROUTES (Only for NOT logged in)
// ==========================================
// If you are logged in, these redirect you to Home

Route::get('/register', function () {
    return view('register');
})->middleware('guest');

Route::post('/register', function () {
    request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);
    $user = User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => Hash::make(request('password')),
    ]);
    Auth::login($user);
    return redirect('/')->with('success', 'Account created successfully!');
})->middleware('guest');

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', function () {
    $attributes = request()->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    if (Auth::attempt($attributes)) {
        request()->session()->regenerate();
        return redirect('/')->with('success', 'Welcome back!');
    }
    return back()->withErrors(['email' => 'Credentials do not match.']);
})->middleware('guest');


// ==========================================
// 3. AUTH ROUTES (Only for LOGGED IN users)
// ==========================================
// If you are not logged in, these redirect you to Login

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/')->with('success', 'You have been logged out.');
})->middleware('auth');

// Create Page (Must be before wildcard {id})
Route::get('/create', function () {
    return view('create');
})->middleware('auth');

// Store Logic
Route::post('/create', function () {
    request()->validate(['title' => 'required', 'artist' => 'required']);
    request()->user()->songs()->create([
            'title' => request('title'),
            'artist' => request('artist'),
            'duration' => request('duration'),
            'album_cover' => request('album_cover'),
        ]);
    return redirect('/')->with('success', 'Song added successfully!');
})->middleware('auth');


// ==========================================
// 4. WILDCARD ROUTES (Must be LAST)
// ==========================================

// Show Details (Public - anyone can see a song)
Route::get('/{id}', function ($id) {
    $song = Song::findOrFail($id);
    return view('show', ['song' => $song]);
});

// Edit Form (Protected - only members can edit)
Route::get('/{id}/edit', function ($id) {
    $song = Song::findOrFail($id);
    return view('edit', ['song' => $song]);
})->middleware('auth');

// Update Logic (Protected)
Route::put('/{id}/update', function ($id) {
    $song = Song::findOrFail($id);
    request()->validate(['title' => 'required', 'artist' => 'required']);
    $song->update([
        'title' => request('title'),
        'artist' => request('artist'),
        'duration' => request('duration'),
        'album_cover' => request('album_cover'),
    ]);
    return redirect('/')->with('success', 'Song updated successfully!');
})->middleware('auth');

// Delete Logic (Protected)
Route::delete('/{id}', function ($id) {
    $song = Song::findOrFail($id);
    $song->delete();
    return redirect('/')->with('success', 'Entity deleted successfully');
})->middleware('auth');