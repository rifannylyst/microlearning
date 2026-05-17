<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pertanyaan;

class Jawaban extends Model
{
    protected $table = 'jawabans';

    protected $fillable = [
        'pertanyaan_id',
        'isian_jawaban',
        'is_benar',
    ];

    public function pertanyaan() {
        return $this->belongsTo(Pertanyaan::class);
    }
}
