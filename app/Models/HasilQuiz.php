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
        'skor',
        'tanggal_dikerjakan',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }
}
