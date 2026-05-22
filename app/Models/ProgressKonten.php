<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressKonten extends Model
{
    protected $fillable = [
        'user_id',
        'konten_materi_id',
        'is_completed',
        'completed_at',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kontenMateri() {
        return $this->belongsTo(KontenMateri::class, 'konten_materi_id');
    }
}
