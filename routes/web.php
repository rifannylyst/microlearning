<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::get('/materi', [App\Http\Controllers\MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{id}', [App\Http\Controllers\MateriController::class, 'show'])->name('materi.show');
    Route::get('materi/{id}/konten', [App\Http\Controllers\MateriController::class, 'konten'])->name('materi.konten');
    Route::post('materi/{id}/konten/{kontenId}/progress', [App\Http\Controllers\MateriController::class, 'update'])->name('materi.konten.progress');
    Route::get('/materi/{id}/konten/{kontenId}', [App\Http\Controllers\MateriController::class, 'kontenDetail'])->name('materi.konten.detail');
    Route::get('/progress', [App\Http\Controllers\MateriController::class, 'pembelajaranSaya'])->name('progress');
    //Route::get('/search', [App\Http\Controllers\UtilsController::class, 'search'])->name('search');
});

Route::middleware(['auth', 'admin'])
->prefix('admin')
->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/materi', [App\Http\Controllers\AdminController::class, 'materi'])->name('admin.materi');
    Route::post('/materi', [App\Http\Controllers\AdminController::class, 'materiStore'])->name('admin.materi.store');
    Route::get('/materi/{id}', [App\Http\Controllers\AdminController::class, 'materiDetail'])->name('admin.materi.detail-materi');
    Route::post('/materi/{id}/konten', [App\Http\Controllers\AdminController::class, 'kontenStore'])->name('admin.materi.konten.store');
    Route::put('/materi/{id}/konten/{kontenId}', [App\Http\Controllers\AdminController::class, 'kontenUpdate'])->name('admin.materi.konten.update');
    Route::delete('/materi/{id}/konten/{kontenId}', [App\Http\Controllers\AdminController::class, 'kontenDelete'])->name('admin.materi.konten.delete');
    Route::post('/materi/{id}/quiz', [App\Http\Controllers\AdminController::class, 'tambahQuiz'])->name('admin.materi.quiz.store');
    Route::get('/quiz/{id}', [App\Http\Controllers\AdminController::class, 'detailQuiz'])->name('admin.quiz.detail-quiz');
    Route::post('/pertanyaan', [App\Http\Controllers\AdminController::class, 'pertanyaanStore'])->name('admin.pertanyaan.store');
    Route::get('/pengguna', [App\Http\Controllers\AdminController::class, 'pengguna'])->name('admin.pengguna');
});