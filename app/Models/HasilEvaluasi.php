<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilEvaluasi extends Model
{
    protected $fillable = ['evaluasi_id', 'user_id', 'jumlah_benar', 'jumlah_salah', 'nilai'];

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
