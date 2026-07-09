<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\jawaban_siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\ProgressKonten;
use App\Models\KontenMateri;
use App\Models\Progress;
use App\Models\Quiz;
use App\Models\HasilQuiz;
use App\Models\Pertanyaan;
use App\Helpers\NotificationHelper;
use App\Models\Notifications;

class MateriController extends Controller
{
        public function index()
        {
            $bookmarkedMateriIds = Auth::user()->bookmarks()->pluck('materi_id')->toArray();

            $materis = Materi::with('user')->orderBy('created_at', 'asc')->get();
            return view('content.materi', compact('materis', 'bookmarkedMateriIds'));
        }
    
        public function show($id)
        {
            $materi = Materi::with('user', 'konten_materi', 'quiz')->findOrFail($id);
            return view('materi.show', compact('materi'));
        }

        public function konten($id)
        {
            $materi = Materi::with(['konten_materi', 'quiz'])->findOrFail($id);
            $userId = Auth::id();
            $kontens = $materi->konten_materi;

            foreach ($kontens as $konten) {
                $konten->unlocked = true;
            }
            
            $kontenSelesai = ProgressKonten::where('user_id', $userId)
                ->whereIn('konten_materi_id', $kontens->pluck('id'))
                ->where('is_completed', true)
                ->count();

            $quizUnlocked = $kontenSelesai > 3;

            $hasilQuiz = HasilQuiz::where('user_id', $userId)
                ->get()
                ->keyBy('quiz_id');

            $this->updateProgressByTipe(
                $userId,
                $materi->id,
                'materi'
            );
            
            $this->updateProgressByTipe(
                $userId,
                $materi->id,
                'video'
            );
            
            $this->updateProgressByTipe(
                $userId,
                $materi->id,
                'audio'
            );

            $progressMateri = Progress::where('user_id', $userId)
                ->where('materi_id', $materi->id)
                ->where('tipe', 'materi')
                ->first();

            $progressVideo = Progress::where('user_id', $userId)
                ->where('materi_id', $materi->id)
                ->where('tipe', 'video')
                ->first();

            $progressAudio = Progress::where('user_id', $userId)
                ->where('materi_id', $materi->id)
                ->where('tipe', 'audio')
                ->first();

            return view('content.detail', compact(
                'materi',
                'quizUnlocked',
                'hasilQuiz',
                'progressMateri',
                'progressVideo',
                'progressAudio'
            ));
        }

        private function updateProgressByTipe($userId, $materiId, $tipe)
        {
            // Ambil semua konten berdasarkan tipe
            $kontens = \App\Models\KontenMateri::where('materi_id', $materiId)
                ->where('tipe', $tipe)
                ->get();

            $totalKonten = $kontens->count();

            // Hitung konten selesai
            $kontenSelesai = ProgressKonten::where('user_id', $userId)
            ->whereIn(
                'konten_materi_id',
                $kontens->pluck('id')
            )
            ->where('is_completed', true)
            ->count();

            // Hitung persentase
            $persentase = $totalKonten > 0
                ? round(($kontenSelesai / $totalKonten) * 100)
                : 0;

            // Tentukan status
            if ($persentase == 0) {
                $status = 'belum_dimulai';
            } elseif ($persentase < 100) {
                $status = 'sedang_dikerjakan';
            } else {
                $status = 'selesai';
            }

            // Simpan/update progress
            Progress::updateOrCreate(
                [
                    'user_id' => $userId,
                    'materi_id' => $materiId,
                    'tipe' => $tipe
                ],

                [
                    'persentase' => $persentase,
                    'status' => $status,
                    'last_accessed' => now()
                ]
            );
        }

        public function kontenByTipe($id, $tipe)
        {
            $materi = Materi::findOrFail($id);

            $kontens = KontenMateri::where('materi_id', $id)
                ->where('tipe', $tipe)
                ->get();

            return view('content.tipe', compact('materi', 'kontens', 'tipe'));
        }

        public function update($id, $kontenId, Request $request)
        {
            $userId = Auth::id();

            $progress = ProgressKonten::updateOrCreate(
                [
                    'user_id' => $userId,
                    'konten_materi_id' => $kontenId,
                ],
                [
                    'is_completed' => true,
                    'completed_at' => now(),
                ]
            );

            //total konten dalam materi
            $totalKonten = KontenMateri::where('materi_id', $id)->count();

            //total konten yang sudah diselesaikan user
            $selesai = ProgressKonten::where('user_id', $userId)
                ->whereHas('kontenMateri', function($query) use ($id) {
                    $query->where('materi_id', $id);
                })
                ->where('is_completed', true)
                ->count();

            $persentase = ($selesai / $totalKonten) * 100;

            $status = 'sedang_dikerjakan';
            if ($persentase == 100) {
                $status = 'selesai';
            }

            //update progress materi
            Progress::updateOrCreate(
                [
                    'user_id' => $userId,
                    'materi_id' => $id,
                ],
                [
                    'status' => $status,
                    'persentase' => $persentase,
                    'last_accessed_at' => now(),
                ]
            );

            // Ambil nama materi
            $materi = Materi::find($id);

            // Pesan notifikasi
            if ($persentase == 100) {
                $pesan = "Selamat! Anda telah menyelesaikan semua konten pada materi {$materi->judul}.";
            } else {
                $pesan = "Anda telah menyelesaikan {$selesai} dari {$totalKonten} konten pada materi {$materi->judul} ({$persentase}%).";
            }
            // Cek apakah notifikasi dengan progress yang sama sudah ada
            $exists = Notifications::where('user_id', $userId)
                ->where('tipe', 'progress')
                ->where('reference_id', $id)
                ->where('pesan', $pesan)
                ->exists();

            if (!$exists) {

                NotificationHelper::create(
                    $userId,
                    'progress',
                    'Progress Materi Diperbarui',
                    $pesan,
                    'materi',
                    $id
                );

            }


            return redirect()->route('materi.konten', $id)->with('success', 'Progress konten berhasil diperbarui.');
        }

        public function kontenDetail($id, $tipe, $kontenId)
        {
            $konten = KontenMateri::where('materi_id', $id)
                ->where('id', $kontenId)
                ->where('tipe', $tipe)
                ->firstOrFail();

            return view('content.konten', compact(
                'konten',
                'id',
                'tipe'
            ));
        }

        public function pembelajaranSaya()
        {
            $userId = auth()->id();

            $materis = Materi::with([
                'quiz.hasilQuiz' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])->get();

            $progress = Progress::where('user_id', $userId)
                ->get()
                ->groupBy([
                    'materi_id',
                    'tipe'
                ]);

            $punyaProgress = Progress::where('user_id', $userId)
            ->where('persentase', '>', 0)
            ->exists();

            return view('content.progress', compact(
                'materis',
                'progress',
                'punyaProgress'
            ));
        }

        public function quiz($id, $quizId)
        {
            $quiz = Quiz::with('pertanyaan.jawaban')->findOrFail($quizId);
            
            $jawabanSiswa = jawaban_siswa::where('user_id', Auth::id())
                ->where('quiz_id', $quizId)
                ->get()
                ->keyBy('pertanyaan_id');

            $sudahDikerjakan = HasilQuiz::where('user_id', Auth::id())
                ->where('quiz_id', $quizId)
                ->exists();
            
            return view('content.quiz', compact(
                'quiz',
                'jawabanSiswa',
                'sudahDikerjakan'
            ));
        }

        public function submitQuiz(Request $request, $id, $quizId)
        {
            $userId = Auth::id();

            $quiz = Quiz::with('pertanyaan.jawaban')
                ->findOrFail($quizId);

            $benar = 0;
            $total = $quiz->pertanyaan->count();

            /*
            |--------------------------------------------------------------------------
            | PILIHAN GANDA
            |--------------------------------------------------------------------------
            */
            if ($request->jawaban) {

                foreach ($request->jawaban as $pertanyaanId => $jawabanId) {

                    // simpan jawaban siswa
                    jawaban_siswa::create([
                        'quiz_id' => $quizId,
                        'user_id' => $userId,
                        'pertanyaan_id' => $pertanyaanId,
                        'pilihan_jawaban_id' => $jawabanId,
                        'isian_jawaban' => null
                    ]);

                    // cek jawaban benar
                    $jawabanBenar = Jawaban::where('id', $jawabanId)
                        ->where('is_benar', true)
                        ->exists();

                    if ($jawabanBenar) {
                        $benar++;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | ESSAY
            |--------------------------------------------------------------------------
            */
            if ($request->isian) {

                foreach ($request->isian as $pertanyaanId => $jawabanText) {

                    jawaban_siswa::create([
                        'quiz_id' => $quizId,
                        'user_id' => $userId,
                        'pertanyaan_id' => $pertanyaanId,
                        'pilihan_jawaban_id' => null,
                        'isian_jawaban' => $jawabanText
                    ]);

                    // essay dianggap benar otomatis
                    if (!empty($jawabanText)) {
                        $benar++;
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | HITUNG SCORE
            |--------------------------------------------------------------------------
            */
            $score = 0;

            if ($total > 0) {
                $score = round(($benar / $total) * 100);
            }

            /*
            |--------------------------------------------------------------------------
            | SIMPAN HASIL QUIZ
            |--------------------------------------------------------------------------
            */
            HasilQuiz::updateOrCreate(
                [
                    'user_id' => $userId,
                    'quiz_id' => $quizId,
                ],
                [
                    'score' => $score,
                    'jumlah_benar' => $benar,
                    'jumlah_soal' => $total,
                    'status' => $score >= 75 ? 'lulus' : 'tidak_lulus',
                ]
            );

            return redirect()
                ->route('materi.konten', $id)
                ->with('success', 'Quiz berhasil diselesaikan');
        }
}
