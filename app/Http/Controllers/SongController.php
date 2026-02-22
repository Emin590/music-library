<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    public function index() {
        $songs = Auth::check() ? Auth::user()->songs()->latest()->get() : [];
        return view('index', compact('songs'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request)
    {
        // This is the "Server-Side" validation part.
        // If any of these fail, Laravel automatically redirects back to the form
        // and sends an $errors variable to your view.
        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'artist' => 'required|min:2|max:255',
            'duration' => ['nullable', 'regex:/^[0-9]{1,2}:[0-9]{2}$/'], // Validates format like 3:45
            'album_cover' => 'nullable|url',
        ], [
            // Custom messages so your exam project looks extra polished
            'duration.regex' => 'The duration must be in the format MM:SS (e.g., 3:45).',
        ]);

        // If validation passes, create the song
        $request->user()->songs()->create($validated);

        return redirect('/')->with('success', 'Song added successfully!');
    }

    public function show($id)
    {
        // Find the song or throw a 404 error if it doesn't exist
        $song = Song::findOrFail($id);

        // Return the specific 'show' view with the song data
        return view('show', compact('song'));
    }

    public function edit($id) {
        $song = Song::findOrFail($id);
        return view('edit', compact('song'));
    }

    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id); // Model interaction [cite: 41]

        // Form validation - a "Dynamic Component" feature [cite: 34, 116]
        $validated = $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'duration' => 'nullable',
            'album_cover' => 'nullable|url'
        ]);

        $song->update($validated); // Information storage [cite: 8]

        return redirect('/')->with('success', 'Song updated successfully!');
    }

    public function destroy($id)
    {
        // 1. Find the song
        $song = Song::findOrFail($id);

        // 2. Extra Security: Check if the song belongs to the logged-in user
        // (This prevents User A from deleting User B's songs)
        if ($song->user_id !== auth()->id()) {
            return back()->withErrors('You do not have permission to delete this song.');
        }

        $song->delete();

        return redirect('/')->with('success', 'Song removed from library.');
    }
}