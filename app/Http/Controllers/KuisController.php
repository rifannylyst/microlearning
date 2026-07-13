<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\KontenMateri;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Pertanyaan;
use App\Models\Jawaban;
use App\Helpers\NotificationHelper;

class KuisController extends Controller
{
    public function tambahQuiz(Request $request, $materiId)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $validatedData['materi_id'] = $materiId;

        Quiz::create($validatedData);

        $students = User::where('role', 'user')->get();

        foreach ($students as $student) {
            NotificationHelper::create(
                $student->id,
                'quiz',
                'Quiz Baru Tersedia',
                'Quiz baru "' . $validatedData['judul'] . '" telah ditambahkan. Silakan cek quiz terbaru di platform.',
                'quiz',
                Quiz::latest()->first()->id
            );
        }

        return redirect()->route('admin.materi.detail-materi', $materiId)->with('success', 'Quiz berhasil ditambahkan.');
    }

    public function editQuiz(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $quiz->update($validatedData);

        return redirect()->route('admin.materi.detail-materi', $quiz->materi_id)->with('success', 'Quiz berhasil diperbarui.');
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $materiId = $quiz->materi_id;
        $quiz->delete();

        return redirect()->route('admin.materi.detail-materi', $materiId)->with('success', 'Quiz berhasil dihapus.');
    }

    public function detailQuiz($id)
    {
        $quiz = Quiz::with('pertanyaan', 'pertanyaan.jawaban')->findOrFail($id);
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

    public function pertanyaanUpdate(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);

        $validatedData = $request->validate([
            'soal' => 'required|string',
            'tipe' => 'required|in:pilihan_ganda,isian',
        ]);

        $pertanyaan->update($validatedData);

        return redirect()->route('admin.quiz.detail-quiz', $pertanyaan->quiz_id)->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function pertanyaanDelete($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $quizId = $pertanyaan->quiz_id;
        $pertanyaan->delete();

        return redirect()->route('admin.quiz.detail-quiz', $quizId)->with('success', 'Pertanyaan berhasil dihapus.');
    }

   public function jawabanStore(Request $request)
    {
        $sudahAda = Jawaban::where(
            'pertanyaan_id',
            $request->pertanyaan_id
        )->exists();

        if ($sudahAda) {
            return back()->with(
                'error',
                'Jawaban untuk pertanyaan ini sudah ada. Silakan edit jawaban yang sudah tersedia.'
            );
        }

        // CEK JIKA PILIHAN GANDA
        if ($request->a || $request->b || $request->c || $request->d) {

            $data = [

                'A' => $request->a,
                'B' => $request->b,
                'C' => $request->c,
                'D' => $request->d,
            ];

            foreach ($data as $huruf => $isi) {

                // jika input tidak kosong
                if ($isi != null) {

                    Jawaban::create([

                        'pertanyaan_id' => $request->pertanyaan_id,

                        'jawaban' => $isi,

                        'is_benar' => $request->jawaban_benar == $huruf
                    ]);
                }
            }
        }

        // JIKA ESSAY
        else {

            Jawaban::create([

                'pertanyaan_id' => $request->pertanyaan_id,

                'jawaban' => $request->jawaban,

                'is_benar' => true
            ]);
        }

        return back()
            ->with('success', 'Jawaban berhasil ditambahkan');
    }

    public function jawabanUpdate(Request $request, $id)
    {
        $jawaban = Jawaban::findOrFail($id);

        $validatedData = $request->validate([
            'jawaban' => 'required|string',
            'is_benar' => 'required|boolean',
        ]);

        // Jika jawaban ini dipilih sebagai jawaban benar
        if ($validatedData['is_benar']) {

            Jawaban::where(
                'pertanyaan_id',
                $jawaban->pertanyaan_id
            )->update([
                'is_benar' => 0
            ]);
        }

        $jawaban->update($validatedData);

        return back()->with(
            'success',
            'Jawaban berhasil diperbarui.'
        );
    }

    public function jawabanDelete($id)
    {
        $jawaban = Jawaban::findOrFail($id);
        $jawaban->delete();

        return back()->with('success', 'Jawaban berhasil dihapus.');
    }
}
