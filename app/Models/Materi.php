<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\KontenMateri;
use App\Models\Quiz;
use App\Models\Progress;

class Materi extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'urutan',
        'created_by',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function konten_materi() {
        return $this->hasMany(KontenMateri::class, 'materi_id');
    }

    public function quiz() {
        return $this->hasMany(Quiz::class);
    }

    public function progress() {
        return $this->hasMany(Progress::class, 'materi_id');
    }
}
