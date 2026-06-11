<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalEvaluasi extends Model
{
    protected $fillable = [
        'evaluasi_id', 'soal', 'tipe', 'opsi_jawaban', 'kunci_jawaban'
    ];

    protected $casts = [
        'opsi_jawaban' => 'array',
    ];

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class);
    }

    public function jawabanEvaluasi()
    {
        return $this->hasMany(JawabanEvaluasi::class);
    }
}
