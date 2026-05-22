<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quiz;

class HasilQuiz extends Model
{
    protected $table = 'hasil_quizzes';

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'jumlah_benar',
        'jumlah_soal',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
