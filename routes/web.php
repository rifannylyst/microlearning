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
    Route::get('materi/{id}/next-urutan/{tipe}', [App\Http\Controllers\AdminController::class, 'getNextUrutan'])->name('admin.materi.konten.next-urutan');
    Route::post('/materi/{id}/quiz', [App\Http\Controllers\KuisController::class, 'tambahQuiz'])->name('admin.materi.quiz.store');
    Route::get('/quiz/{id}', [App\Http\Controllers\KuisController::class, 'detailQuiz'])->name('admin.quiz.detail-quiz');
    Route::post('/pertanyaan/{quizId}', [App\Http\Controllers\KuisController::class, 'pertanyaanStore'])->name('admin.pertanyaan.store');
    Route::put('/pertanyaan/{id}', [App\Http\Controllers\KuisController::class, 'pertanyaanUpdate'])->name('admin.pertanyaan.update');
    Route::delete('/pertanyaan/{id}', [App\Http\Controllers\KuisController::class, 'pertanyaanDelete'])->name('admin.pertanyaan.destroy');
    Route::post('/jawaban', [App\Http\Controllers\KuisController::class, 'jawabanStore'])->name('admin.jawaban.store');
    Route::put('/jawaban/{id}', [App\Http\Controllers\KuisController::class, 'jawabanUpdate'])->name('admin.jawaban.update');
    Route::delete('/jawaban/{id}', [App\Http\Controllers\KuisController::class, 'jawabanDelete'])->name('admin.jawaban.destroy');
    Route::get('/pengguna', [App\Http\Controllers\AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/progress', [App\Http\Controllers\AdminController::class, 'progress'])->name('admin.progress');
    Route::get('/progress/{id}', [App\Http\Controllers\AdminController::class, 'detailProgress'])->name('admin.progress.detail');
    });