<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Bookmarks;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifications;
use App\Models\HasilEvaluasi;

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
            return response()->json([
            'status' => 'removed'
        ]);
        } 
        
        Bookmarks::create([
        'user_id' => Auth::id(),
        'materi_id' => $materiId
        ]);

        return response()->json([
            'status' => 'added'
        ]);
    }

    public function bookmarks()
    {
        $materis = Materi::whereIn('id', Auth::user()
        ->bookmarks()
        ->pluck('materi_id')
        )->get();

        return view('content.bookmarks', compact('materis'));
    }

    public function evaluasi(){
        $evaluasis = Evaluasi::withCount('soal')
             ->with(['hasil' => function ($query) {
                 $query->where('user_id', auth()->id());
             }])
             ->latest()
             ->get();


        return view('content.evaluasi', compact('evaluasis'));
    }

    public function notifications()
    {
        $notifications = Notifications::where('user_id', Auth::id())
            ->latest()
            ->get();

        // Mark all notifications as read
        Notifications::where('user_id', Auth::id())->update(['is_read' => true]);

        return view('content.notifications', compact('notifications'));
    }

    public function read($id)
    {
        $notification = Notifications::findOrFail($id);

        if ($notification->user_id != auth()->id()) {
            abort(403);
        }

        $notification->update([
            'is_read' => true
        ]);

        switch ($notification->tipe) {

            case 'materi':
                return redirect()->route(
                    'materi.show',
                    $notification->reference_id
                );

            case 'quiz':
                return redirect()->route(
                    'materi.index'
                );

            case 'evaluasi':
                return redirect()->route(
                    'evaluasi'
                );

            case 'progress':
                return redirect()->route(
                    'progress'
                );

            default:
                return redirect()->route('home');
        }
    }

}
