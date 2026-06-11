<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanEvaluasi extends Model
{
    protected $fillable = ['soal_evaluasi_id', 'user_id', 'jawaban', 'benar'];

    public function soal()
    {
        return $this->belongsTo(SoalEvaluasi::class, 'soal_evaluasi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
