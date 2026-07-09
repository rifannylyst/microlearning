<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Evaluasi;
use App\Http\Controllers\Controller;
use App\Models\SoalEvaluasi;
use App\Models\HasilEvaluasi;
use App\Models\JawabanEvaluasi;
use App\Helpers\NotificationHelper;
use App\Models\User;

class EvaluasiController extends Controller
{
    public function index()
    {
        $evaluasis = Evaluasi::withCount('soal')->latest()->get();

        return view('admin.pages.evaluasi', compact('evaluasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable'
        ]);

        Evaluasi::create($request->only([
            'judul',
            'deskripsi'
        ]));

        $students = User::where('role', 'user')->get();

        foreach ($students as $student) {
            NotificationHelper::create(
                $student->id,
                'evaluasi',
                'Evaluasi Baru Tersedia',
                'Evaluasi baru "' . $request->judul . '" telah ditambahkan. Silakan cek evaluasi terbaru di platform.',
                'evaluasi',
                Evaluasi::latest()->first()->id
            );
        }

        return back()->with('success', 'Evaluasi Berhasil Ditambahkan');
    }

    public function update(Request $request, Evaluasi $evaluasi)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable'
        ]);

        $evaluasi->update($request->only([
            'judul',
            'deskripsi'
        ]));

        return back()->with('success', 'Evaluasi berhasil diperbarui');
    }

    public function destroy(Evaluasi $evaluasi)
    {
        $evaluasi->delete();

        return back()->with('success', 'Evaluasi berhasil dihapus');
    }

    public function indexSoal(Evaluasi $evaluasi)
    {
        $soals = $evaluasi->soal()->get();

        return view('admin.pages.evaluasi-soal',compact('evaluasi', 'soals'));
    }

    public function storeSoal(Request $request)
    {
        $request->validate([
            'evaluasi_id' => 'required|exists:evaluasis,id',
            'soal' => 'required',
            'tipe' => 'required|in:pilihan_ganda,isian',
        ]);

        $data = [
            'evaluasi_id' => $request->evaluasi_id,
            'soal' => $request->soal,
            'tipe' => $request->tipe,
        ];

        if ($request->tipe == 'pilihan_ganda') {

            $request->validate([
                'opsi_a' => 'required',
                'opsi_b' => 'required',
                'opsi_c' => 'required',
                'opsi_d' => 'required',
                'kunci_jawaban' => 'required|in:A,B,C,D',
            ]);

            $data['opsi_jawaban'] = [
                $request->opsi_a,
                $request->opsi_b,
                $request->opsi_c,
                $request->opsi_d,
            ];

            $data['kunci_jawaban'] = $request->kunci_jawaban;
        }

        else {
            $data['opsi_jawaban'] = null;
            $data['kunci_jawaban'] = null;
        }

        SoalEvaluasi::create($data);

        return back()->with('success', 'Soal berhasil ditambahkan');
    }

    public function updateSoal(Request $request, SoalEvaluasi $soal)
    {
        $data = [
            'soal' => $request->soal,
            'tipe' => $request->tipe,
        ];

        if ($request->tipe == 'pilihan_ganda') {

            $data['opsi_jawaban'] = [
                $request->opsi_a,
                $request->opsi_b,
                $request->opsi_c,
                $request->opsi_d,
            ];

            $data['kunci_jawaban'] = $request->kunci_jawaban;
        } else {

            $data['opsi_jawaban'] = null;
            $data['kunci_jawaban'] = null;
        }

        $soal->update($data);

        return back()->with('success', 'Soal berhasil diperbarui');
    }

    public function destroySoal(SoalEvaluasi $soal)
    {
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus');
    }

    public function show(Evaluasi $evaluasi)
    {
        $evaluasi->load('soal');

        // Cek apakah siswa sudah pernah mengerjakan
        $hasil = HasilEvaluasi::where('evaluasi_id', $evaluasi->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($hasil) {
            return redirect()->route(
                'siswa.evaluasi.hasil',
                $evaluasi->id
            );
        }

        return view(
            'content.evaluasi-show',
            compact('evaluasi')
        );
    }

    /**
     * Submit jawaban
     */
    public function submit(Request $request, Evaluasi $evaluasi)
    {
        $request->validate([
            'jawaban' => 'required|array'
        ]);

        DB::beginTransaction();

        try {

            $jumlahBenar = 0;

            $jumlahPG = $evaluasi->soal()
                ->where('tipe', 'pilihan_ganda')
                ->count();

            foreach ($request->jawaban as $soalId => $jawaban) {

                $soal = SoalEvaluasi::find($soalId);

                if (!$soal) {
                    continue;
                }

                $benar = null;

                // Soal Pilihan Ganda
                if ($soal->tipe == 'pilihan_ganda') {

                    $benar = $jawaban == $soal->kunci_jawaban;

                    if ($benar) {
                        $jumlahBenar++;
                    }
                }

                // Simpan jawaban siswa
                JawabanEvaluasi::create([
                    'soal_evaluasi_id' => $soal->id,
                    'user_id'          => auth()->id(),
                    'jawaban'          => $jawaban,
                    'benar'            => $benar,
                ]);
            }

            // Hitung nilai hanya dari soal PG
            $nilai = $jumlahPG > 0
                ? round(($jumlahBenar / $jumlahPG) * 100, 2)
                : 0;

            HasilEvaluasi::create([
                'evaluasi_id'  => $evaluasi->id,
                'user_id'      => auth()->id(),
                'jumlah_benar' => $jumlahBenar,
                'jumlah_salah' => $jumlahPG - $jumlahBenar,
                'nilai'        => $nilai,
            ]);

            DB::commit();

            NotificationHelper::create(
                auth()->id(),
                'evaluasi',
                'Evaluasi Selesai',
                "Selamat! Anda telah menyelesaikan evaluasi '{$evaluasi->judul}'",
                'evaluasi',
                $evaluasi->id
            );

            return redirect()->route(
                'siswa.evaluasi.hasil',
                $evaluasi->id
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Terjadi kesalahan saat menyimpan jawaban.'
            );
        }
    }

    /**
     * Hasil evaluasi
     */
    public function hasil(Evaluasi $evaluasi)
    {
        $jawabans = JawabanEvaluasi::with('soal')
            ->where('user_id', auth()->id())
            ->whereHas('soal', function ($query) use ($evaluasi) {
                $query->where('evaluasi_id', $evaluasi->id);
            })
            ->get();

        return view(
            'content.evaluasi-hasil',
            compact('evaluasi', 'jawabans')
        );
    }

    public function adminHasil()
    {
        $hasil = JawabanEvaluasi::with([
        'user',
        'soal.evaluasi'
    ])
    ->get()
    ->groupBy('user_id');

    return view(
        'admin.pages.evaluasi-hasil',
        compact('hasil')
    );
    }

    public function nilai(Request $request, $id)
    {
        $jawaban = JawabanEvaluasi::findOrFail($id);

        $jawaban->update([
            'benar' => $request->benar
        ]);

        return back()->with(
            'success',
            'Jawaban berhasil dinilai'
        );
    }

    public function detail($userId)
    {
        $jawabans = JawabanEvaluasi::with([
            'user',
            'soal.evaluasi'
        ])
        ->where('user_id', $userId)
        ->get();

        $user = $jawabans->first()?->user;

        return view(
            'admin.pages.evaluasi-detail',
            compact('jawabans', 'user')
        );
    }
}
