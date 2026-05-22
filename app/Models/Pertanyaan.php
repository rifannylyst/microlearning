<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz;
use App\Models\Jawaban;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaans';

    protected $fillable = [
        'quiz_id',
        'soal',
        'tipe',
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class);
    }

    public function pilihanGanda(): bool {
        return $this->tipe === 'pilihan_ganda';
    }
}
