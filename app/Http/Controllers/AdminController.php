<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\KontenMateri;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Pertanyaan;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function materi(Request $request)
    {
        $query = Materi::query();
        $materis = $query->get();
        $admins = User::where('role', 'admin')->get();
        return view('admin.pages.materi', compact('materis', 'admins'));
    }

    public function materiStore(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'created_by' => 'required|exists:users,id',
        ]);


        Materi::create($validatedData);

        //Ambil seluruh Siswa
        $students = User::where('role', 'user')->get();

        foreach ($students as $student) {
            NotificationHelper::create(
                $student->id,
                'materi',
                'Materi Baru Tersedia',
                'Materi baru "' . $validatedData['judul'] . '" telah ditambahkan. Silakan cek materi terbaru di platform.',
                'materi',
                Materi::latest()->first()->id
            );
        }

        return redirect()->route('admin.materi')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function materiDetail($id)
    {
        $materi = Materi::with('konten_materi')->findOrFail($id);
        //$nextUrutan = (KontenMateri::where('materi_id', $id)->max('urutan') ?? 0) + 1;
        $admins = User::where('role', 'admin')->get();
        return view('admin.pages.detail-materi', compact('materi', 'admins'));
    }

    public function materiUpdate(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'created_by' => 'required|exists:users,id',
        ]);

        $materi->update($validatedData);

        return redirect()->route('admin.materi')->with('success', 'Materi berhasil diperbarui.');
    }

    public function materiDelete($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('admin.materi')->with('success', 'Materi berhasil dihapus.');
    }

   public function kontenStore(Request $request, $materiId)
    {
        $rules = [
            'tipe' => 'required|in:materi,video,audio',
            'deskripsi' => 'nullable|string',
            'durasi' => 'nullable|integer',
        ];

        // Validasi file sesuai tipe
        if ($request->tipe == 'video') {
            $rules['isi'] = 'required|file|mimes:mp4|max:20480';
        } elseif ($request->tipe == 'audio') {
            $rules['isi'] = 'required|file|mimes:mp3|max:20480';
        } elseif ($request->tipe == 'materi') {
            $rules['isi'] = 'required|file|mimes:pdf,doc,docx|max:20480';
        }

        $validatedData = $request->validate($rules);

        $path = null;

        if ($request->hasFile('isi')) {
            $path = $request->file('isi')->store('konten_materi', 'public');
        }

        KontenMateri::create([
            'materi_id' => $materiId,
            'tipe' => $validatedData['tipe'],
            'isi' => $path,
            'link' => $request->input('link'),
            'deskripsi' => $validatedData['deskripsi'] ?? null,
            'durasi' => $validatedData['durasi'] ?? null,
        ]);

       
        return redirect()
            ->route('admin.materi.detail-materi', $materiId)
            ->with('success', 'Konten materi berhasil ditambahkan.');
    }
    public function pengguna(Request $request)
    {
        $pengguna = User::all();
        return view('admin.pages.pengguna', compact('pengguna'));
    }

    public function penggunaUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function penggunaStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function penggunaDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function kontenUpdate(Request $request, $id, $kontenId)
    {
        $konten = KontenMateri::findOrFail($kontenId);

        $konten->update([
            'tipe' => $request->tipe,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
        ]);

        if ($request->hasFile('isi')) {

            $path = $request->file('isi')->store('konten_materi', 'public');

            $konten->update([
                'isi' => $path
            ]);
        }

        return redirect()
            ->route('admin.materi.detail-materi', $id)
            ->with('success', 'Konten materi berhasil diperbarui.');
    }

    public function kontenDelete($id){
        $konten = KontenMateri::findOrFail($id);
        $materiId = $konten->materi_id;
        $konten->delete();

        return redirect()->route('admin.materi.detail-materi', $materiId)->with('success', 'Konten materi berhasil dihapus.');
    }
    
    /*public function getNextUrutan($id, $tipe)
    {
       $lastUrutan = KontenMateri::where('materi_id', $id)
        ->where('tipe', $tipe);

        return response()->json([
            'nextUrutan' => ($lastUrutan ?? 0) + 1
        ]);
    } */
    
    public function progress()
    {
        $users = User::with([
            'progress',
            'hasil_quiz'
        ])->where('role', 'user')->get();

        $totalMateri = Materi::count();

        return view('admin.pages.progress', compact('users', 'totalMateri'));
    }

    public function detailProgress($id)
    {
        $user = User::with([
            'progress',
            'hasil_quiz.quiz'
        ])->findOrFail($id);

        $materi = Materi::with('konten_materi')->get();

        return view('admin.pages.detail-progress', compact('user', 'materi'));
    }

}
