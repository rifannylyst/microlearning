<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
Route::get('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\LoginController::class, 'registerUser']);

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::get('/materi', [App\Http\Controllers\MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{id}', [App\Http\Controllers\MateriController::class, 'show'])->name('materi.show');
    Route::get('materi/{id}/konten', [App\Http\Controllers\MateriController::class, 'konten'])->name('materi.konten');
    Route::get('materi/{id}/konten/{tipe}', [App\Http\Controllers\MateriController::class, 'kontenByTipe'])->name('materi.konten.tipe');
    Route::post('materi/{id}/konten/{kontenId}/progress', [App\Http\Controllers\MateriController::class, 'update'])->name('materi.konten.progress');
    Route::get('/materi/{id}/konten/{tipe}/{kontenId}', [App\Http\Controllers\MateriController::class, 'kontenDetail'])->name('materi.konten.detail');
    Route::get('/materi/{id}/quiz/{quizId}', [App\Http\Controllers\MateriController::class, 'quiz'])->name('materi.quiz.detail');
    Route::post('/materi/{id}/quiz/{quizId}/submit', [App\Http\Controllers\MateriController::class, 'submitQuiz'])->name('quiz.submit');
    Route::get('/progress', [App\Http\Controllers\MateriController::class, 'pembelajaranSaya'])->name('progress');
    //Route::get('/search', [App\Http\Controllers\UtilsController::class, 'search'])->name('search');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
    Route::post('/bookmark/{materiId}', [App\Http\Controllers\HomeController::class, 'toggleBookmark'])->name('bookmark.toggle');
    Route::get('/bookmarks', [App\Http\Controllers\HomeController::class, 'bookmarks'])->name('bookmarks');
    Route::get('/evaluasi', [App\Http\Controllers\HomeController::class, 'evaluasi'])->name('evaluasi');
    Route::get('/evaluasi/{evaluasi}', [App\Http\Controllers\EvaluasiController::class, 'show'])->name('siswa.evaluasi.show');
    Route::post('/evaluasi/{evaluasi}/submit', [App\Http\Controllers\EvaluasiController::class, 'submit'])->name('siswa.evaluasi.submit');
    Route::get('/evaluasi/{evaluasi}/hasil', [App\Http\Controllers\EvaluasiController::class, 'hasil'])->name('siswa.evaluasi.hasil');
    Route::get('/notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('notifications');
    Route::get('/notifications/read/{id}', [App\Http\Controllers\HomeController::class, 'read'])->name('notifications.read');
    });

Route::middleware(['auth', 'admin'])
->prefix('admin')
->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/materi', [App\Http\Controllers\AdminController::class, 'materi'])->name('admin.materi');
    Route::post('/materi', [App\Http\Controllers\AdminController::class, 'materiStore'])->name('admin.materi.store');
    Route::get('/materi/{id}', [App\Http\Controllers\AdminController::class, 'materiDetail'])->name('admin.materi.detail-materi');
    Route::post('/materi/{id}/konten', [App\Http\Controllers\AdminController::class, 'kontenStore'])->name('admin.materi.konten.store');
    Route::put('/materi/{id}', [App\Http\Controllers\AdminController::class, 'materiUpdate'])->name('admin.materi.update');
    Route::delete('/materi/{id}', [App\Http\Controllers\AdminController::class, 'materiDelete'])->name('admin.materi.destroy');
    Route::put('/materi/{id}/konten/{kontenId}', [App\Http\Controllers\AdminController::class, 'kontenUpdate'])->name('admin.materi.konten.update');
    Route::delete('/materi/{id}/konten/{kontenId}', [App\Http\Controllers\AdminController::class, 'kontenDelete'])->name('admin.materi.konten.delete');
    //Route::get('materi/{id}/next-urutan/{tipe}', [App\Http\Controllers\AdminController::class, 'getNextUrutan'])->name('admin.materi.konten.next-urutan');
    Route::post('/materi/{id}/quiz', [App\Http\Controllers\KuisController::class, 'tambahQuiz'])->name('admin.materi.quiz.store');
    Route::get('/quiz/{id}', [App\Http\Controllers\KuisController::class, 'detailQuiz'])->name('admin.quiz.detail-quiz');
    Route::put('/quiz/{id}', [App\Http\Controllers\KuisController::class, 'editQuiz'])->name('admin.quiz.update');
    Route::delete('/quiz/{id}', [App\Http\Controllers\KuisController::class, 'deleteQuiz'])->name('admin.quiz.destroy');
    Route::post('/pertanyaan/{quizId}', [App\Http\Controllers\KuisController::class, 'pertanyaanStore'])->name('admin.pertanyaan.store');
    Route::put('/pertanyaan/{id}', [App\Http\Controllers\KuisController::class, 'pertanyaanUpdate'])->name('admin.pertanyaan.update');
    Route::delete('/pertanyaan/{id}', [App\Http\Controllers\KuisController::class, 'pertanyaanDelete'])->name('admin.pertanyaan.destroy');
    Route::post('/jawaban', [App\Http\Controllers\KuisController::class, 'jawabanStore'])->name('admin.jawaban.store');
    Route::put('/jawaban/{id}', [App\Http\Controllers\KuisController::class, 'jawabanUpdate'])->name('admin.jawaban.update');
    Route::delete('/jawaban/{id}', [App\Http\Controllers\KuisController::class, 'jawabanDelete'])->name('admin.jawaban.destroy');
    Route::get('/pengguna', [App\Http\Controllers\AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::post('/pengguna', [App\Http\Controllers\AdminController::class, 'penggunaStore'])->name('admin.pengguna.store');
    Route::put('/pengguna/{id}', [App\Http\Controllers\AdminController::class, 'penggunaUpdate'])->name('admin.pengguna.update');
    Route::delete('/pengguna/{id}', [App\Http\Controllers\AdminController::class, 'penggunaDelete'])->name('admin.pengguna.destroy');
    Route::get('/progress', [App\Http\Controllers\AdminController::class, 'progress'])->name('admin.progress');
    Route::get('/progress/{id}', [App\Http\Controllers\AdminController::class, 'detailProgress'])->name('admin.progress.detail');
    Route::get('/evaluasi', [App\Http\Controllers\EvaluasiController::class, 'index'])->name('admin.evaluasi');
    Route::post('/evaluasi', [App\Http\Controllers\EvaluasiController::class, 'store'])->name('admin.evaluasi.store');
    Route::put('/evaluasi/{evaluasi}', [App\Http\Controllers\EvaluasiController::class, 'update'])->name('admin.evaluasi.update');
    Route::delete('/evaluasi/{evaluasi}', [App\Http\Controllers\EvaluasiController::class,'destroy'] )->name('admin.evaluasi.destroy');
    Route::get('/evaluasi/{evaluasi}/soal', [App\Http\Controllers\EvaluasiController::class, 'indexSoal'])->name('admin.evaluasi.soal');
    Route::post('/soal', [App\Http\Controllers\EvaluasiController::class, 'storeSoal'])->name('admin.evaluasi.soal.store');
    Route::put('/soal/{soal}', [App\Http\Controllers\EvaluasiController::class, 'updateSoal'])->name('admin.evaluasi.soal.update');
    Route::delete('/soal/{soal}', [App\Http\Controllers\EvaluasiController::class, 'destroySoal'])->name('admin.evaluasi.soal.destroy');
    Route::get('/evaluasi/hasil', [App\Http\Controllers\EvaluasiController::class, 'adminHasil'])->name('admin.evaluasi.hasil');
    Route::put('/evaluasi/nilai/{id}', [App\Http\Controllers\EvaluasiController::class, 'nilai'])->name('admin.evaluasi.nilai');
    Route::get('/evaluasi/hasil/{user}', [App\Http\Controllers\EvaluasiController::class, 'detail'])->name('admin.evaluasi.detail');
    });