<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view('register');
    }

    public function register(Request $request)
    {
        // 1. Server-side Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Must match password_confirmation
        ]);

        // 2. Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Log them in and redirect
        auth()->login($user);
        return redirect('/')->with('success', 'Account created successfully!');
    }

    public function showLogin() {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Server-side Validation
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt Authentication
        if (auth()->attempt($credentials)) {
            // Regenerate session to prevent "Session Fixation" (Security mark!)
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Welcome back!');
        }

        // 3. Fail: Send back an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); // Keeps the email in the box for the user
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }
}