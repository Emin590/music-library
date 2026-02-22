<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

// 1. Public Index
Route::get('/', [SongController::class, 'index']);

// 2. Guest Routes (Only for logged-out users)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 3. Auth Routes (Only for logged-in users)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Named GET route for the form
    Route::get('/create', [SongController::class, 'create'])->name('songs.create');
    
    // Named POST route for the submission
    Route::post('/create', [SongController::class, 'store'])->name('songs.store');
    
    // Standard routes for Edit, Update, and Delete
    Route::get('/{id}/edit', [SongController::class, 'edit']);
    Route::put('/{id}/update', [SongController::class, 'update']);
    Route::delete('/{id}', [SongController::class, 'destroy']);
});

// 4. Wildcard Route (MUST be at the very bottom)
Route::get('/{id}', [SongController::class, 'show']);