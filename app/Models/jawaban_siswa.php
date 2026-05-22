<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jawaban_siswa extends Model
{
    protected $table = 'jawaban_siswas';
    protected $fillable = [
        'quiz_id',
        'pertanyaan_id',
        'user_id',
        'pilihan_jawaban_id',
        'isian_jawaban',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pilihan_jawaban()
    {
        return $this->belongsTo(Jawaban::class, 'pilihan_jawaban_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
