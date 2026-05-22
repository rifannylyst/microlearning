<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materi;
use App\Models\Pertanyaan;
use App\Models\HasilQuiz;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'materi_id',
        'judul',
    ];

    public function materi() {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function pertanyaan() {
        return $this->hasMany(Pertanyaan::class, 'quiz_id');
    }

    public function hasilQuiz() {
        return $this->hasMany(HasilQuiz::class, 'quiz_id');
    }
}
