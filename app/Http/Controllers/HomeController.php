<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $materi = Materi::latest('created_at')->take(3)->get();
        return view('content.home', compact('materi'));
    }

    public function profile()
    {
        return view('content.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function toggleBookmark($materiId)
    {
        $bookmark = Bookmarks::where('user_id', Auth::id())->where('materi_id', $materiId)->first();

        if ($bookmark) {
            $bookmark->delete();
        } else {
            Bookmarks::create([
                'user_id' => Auth::id(),
                'materi_id' => $materiId
            ]);
        }

        return redirect()->back();
    }

    public function bookmarks()
    {
        $materis = Materi::whereIn('id', Auth::user()
        ->bookmarks()
        ->pluck('materi_id')
        )->get();

        return view('content.bookmarks', compact('materis'));
    }
}
