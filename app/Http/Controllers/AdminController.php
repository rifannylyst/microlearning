<?php

namespace App\Http\Controllers;

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
        return view('admin.pages.materi', compact('materis'));
    }

    public function materiStore(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        $validatedData['created_by'] = Auth::id();

        Materi::create($validatedData);

        return redirect()->route('admin.materi')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function materiDetail($id)
    {
        $materi = Materi::with('konten_materi')->findOrFail($id);
        $nextUrutan = (KontenMateri::where('materi_id', $id)->max('urutan') ?? 0) + 1;
        return view('admin.pages.detail-materi', compact('materi', 'nextUrutan'));
    }

   public function kontenStore(Request $request, $materiId)
    {
        $validatedData = $request->validate([
            'tipe' => 'required|in:gambar,video,audio',
            'isi' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mp3|max:10240',
            'durasi' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
        ]);

        // urutan otomatis
        $urutan = (KontenMateri::where('materi_id', $materiId)
            ->max('urutan') ?? 0) + 1;

        // default null
        $path = null;

        // jika ada file upload
        if ($request->hasFile('isi')) {
            $path = $request->file('isi')
                ->store('konten_materi', 'public');
        }

        KontenMateri::create([
            'materi_id' => $materiId,
            'tipe' => $validatedData['tipe'],
            'isi' => $path,
            'deskripsi' => $validatedData['deskripsi'] ?? null,
            'durasi' => $validatedData['durasi'] ?? null,
            'urutan' => $urutan,
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

    public function kontenUpdate(Request $request, $id){
        $konten = KontenMateri::findOrFail($id);

        $konten->update([
            'tipe' => $request->input('tipe'),
            'deskripsi' => $request->input('deskripsi'),
            'durasi' => $request->input('durasi'),
            'urutan' => $request->input('urutan'),
        ]);

        //upload file baru
        if ($request->hasFile('isi')) {

            //upload file baru
            $path = $request->file('isi')->store('konten_materi', 'public');
            $konten->update(['isi' => $path]);
        }

        return redirect()->route('admin.materi.detail-materi', $konten->materi_id)->with('success', 'Konten materi berhasil diperbarui.');
    }

    public function kontenDelete($id){
        $konten = KontenMateri::findOrFail($id);
        $materiId = $konten->materi_id;
        $konten->delete();

        return redirect()->route('admin.materi.detail-materi', $materiId)->with('success', 'Konten materi berhasil dihapus.');
    }
    
    public function tambahQuiz(Request $request, $materiId)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $validatedData['materi_id'] = $materiId;

        Quiz::create($validatedData);

        return redirect()->route('admin.materi.detail-materi', $materiId)->with('success', 'Quiz berhasil ditambahkan.');
    }

    public function detailQuiz($id)
    {
        $quiz = Quiz::with('pertanyaan')->findOrFail($id);
        return view('admin.pages.detail-quiz', compact('quiz'));
    }

    public function pertanyaanStore(Request $request, $quizId)
    {
        $validatedData = $request->validate([
            'soal' => 'required|string',
            'tipe' => 'required|in:pilihan_ganda,isian',
        ]);

        $validatedData['quiz_id'] = $quizId;

        Pertanyaan::create($validatedData);

        return redirect()->route('admin.quiz.detail-quiz', $quizId)->with('success', 'Pertanyaan berhasil ditambahkan.');
    }
}
