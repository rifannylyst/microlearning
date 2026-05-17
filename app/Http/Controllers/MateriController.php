<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\ProgressKonten;
use App\Models\KontenMateri;
use App\Models\Progress;

class MateriController extends Controller
{
        public function index()
        {
            $materis = Materi::with('user')->orderBy('created_at', 'asc')->get();
            return view('content.materi', compact('materis'));
        }
    
        public function show($id)
        {
            $materi = Materi::with('user', 'konten_materi', 'quiz')->findOrFail($id);
            return response()->json($materi);
        }

        public function konten($id)
        {
            $materi = Materi::with(['konten_materi' => function($query) {
                $query->orderBy('urutan', 'asc');
            }])->findOrFail($id);

            $userId = Auth::id();

            $kontens = $materi->konten_materi;

            foreach ($kontens as $index => $konten){
                if ($index == 0){
                    $konten->unlocked = true;
                    continue;
                }

                $previousKonten = $kontens[$index - 1];
                $previousCompleted = ProgressKonten::where('user_id', $userId)
                    ->where('konten_materi_id', $previousKonten->id)
                    ->where('is_completed', true)
                    ->exists();
                $konten->unlocked = $previousCompleted;
            }
            
            return view('content.detail', compact('materi'));
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
                ->whereHas('konten_materi', function($query) use ($id) {
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

            return redirect()->route('materi.konten', $id)->with('success', 'Progress konten berhasil diperbarui.');
        }

        public function kontenDetail($id, $kontenId)
        {
            $konten = KontenMateri::findOrFail($kontenId);
            return view('content.konten_detail', compact('konten'));
        }

        public function pembelajaranSaya()
        {
            $progress = Progress::with([
                'materi.konten_materi.progressUser'
            ])
            ->where('user_id', Auth::id())
            ->get();

            return view('content.progress', compact('progress'));
        }
}
