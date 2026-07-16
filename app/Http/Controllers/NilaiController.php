<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Evaluasi;
use App\Models\HasilQuiz;
use App\Models\HasilEvaluasi;
use App\Models\JawabanEvaluasi;

class NilaiController extends Controller
{
    /**
     * Menampilkan halaman index rekap nilai di panel Admin
     */
    public function index()
    {
        // 1. Ambil semua siswa (role user)
        $students = User::where('role', 'user')->get();

        // 2. Ambil semua kuis dan evaluasi untuk dijadikan header kolom
        $quizzes = Quiz::all();
        $evaluasis = Evaluasi::all();

        // 3. Ambil semua hasil kuis dan evaluasi, kelompokkan berdasarkan user_id
        $hasilQuizzes = HasilQuiz::all()->groupBy('user_id');
        $hasilEvaluasis = HasilEvaluasi::all()->groupBy('user_id');

        $hasil = JawabanEvaluasi::with([
        'user',
        'soal.evaluasi'
        ])
        ->get()
        ->groupBy('user_id');

        return view('admin.pages.nilai', compact(
            'students', 
            'quizzes', 
            'evaluasis', 
            'hasilQuizzes', 
            'hasilEvaluasis',
            'hasil'
        ));
    }

    /**
     * Export rekap nilai ke format Excel (.xls) atau CSV (.csv) secara native
     */
    public function export(Request $request)
    {
        $format = $request->query('format', 'xls');
        
        $students = User::where('role', 'user')->get();
        $quizzes = Quiz::all();
        $evaluasis = Evaluasi::all();
        $hasilQuizzes = HasilQuiz::all()->groupBy('user_id');
        $hasilEvaluasis = HasilEvaluasi::all()->groupBy('user_id');

        $filename = "rekap_nilai_siswa_" . date('Y-m-d');

        // Pilihan 1: Export format .xls menggunakan struktur HTML Table (Sangat rapi di Excel)
        if ($format === 'xls') {
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            header("Content-Disposition: attachment; filename=\"{$filename}.xls\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            // Mengirimkan HTML Table dengan styling dasar agar Excel otomatis membacanya sebagai tabel spreadsheet
            echo '<table border="1">';
            echo '<thead>';
            echo '<tr style="background-color: #4f46e5; color: #ffffff; font-weight: bold; text-align: center;">';
            echo '<th>Nama Siswa</th>';
            echo '<th>Email</th>';
            foreach ($quizzes as $quiz) {
                echo '<th>Kuis: ' . htmlspecialchars($quiz->judul) . '</th>';
            }
            foreach ($evaluasis as $evaluasi) {
                echo '<th>Evaluasi: ' . htmlspecialchars($evaluasi->judul) . '</th>';
            }
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($students as $student) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($student->name) . '</td>';
                echo '<td>' . htmlspecialchars($student->email) . '</td>';

                // Nilai Kuis
                foreach ($quizzes as $quiz) {
                    $hasil = $hasilQuizzes->get($student->id)?->firstWhere('quiz_id', $quiz->id);
                    $score = $hasil ? $hasil->score : '-';
                    echo '<td style="text-align: center;">' . $score . '</td>';
                }

                // Nilai Evaluasi
                foreach ($evaluasis as $evaluasi) {
                    $hasil = $hasilEvaluasis->get($student->id)?->firstWhere('evaluasi_id', $evaluasi->id);
                    $nilai = $hasil ? $hasil->nilai : '-';
                    echo '<td style="text-align: center;">' . $nilai . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            exit;
        }

                // Pilihan 2: Menggunakan Native Header & exit; (Bypass Middleware)
        if ($format === 'csv') {
            $filename = "rekap_nilai_siswa_" . date('Y-m-d');

            // Set header secara native
            header("Content-Type: text/csv; charset=utf-8");
            header("Content-Disposition: attachment; filename=\"{$filename}.csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8

            // Header Kolom
            $headerColumns = ['Nama Siswa', 'Email'];
            foreach ($quizzes as $quiz) {
                $headerColumns[] = 'Kuis: ' . $quiz->judul;
            }
            foreach ($evaluasis as $evaluasi) {
                $headerColumns[] = 'Evaluasi: ' . $evaluasi->judul;
            }
            
            fputcsv($file, $headerColumns, ';');

            foreach ($students as $student) {
                $row = [$student->name, $student->email];

                foreach ($quizzes as $quiz) {
                    $hasil = $hasilQuizzes->get($student->id)?->firstWhere('quiz_id', $quiz->id);
                    $row[] = $hasil ? $hasil->score : '-';
                }

                foreach ($evaluasis as $evaluasi) {
                    $hasil = $hasilEvaluasis->get($student->id)?->firstWhere('evaluasi_id', $evaluasi->id);
                    $row[] = $hasil ? $hasil->nilai : '-';
                }

                fputcsv($file, $row, ';');
            }

            fclose($file);
            exit; // <-- SANGAT PENTING: Bypasses middleware
        }
    }
}