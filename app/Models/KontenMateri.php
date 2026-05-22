<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Materi;

class KontenMateri extends Model
{
    protected $table = 'konten_materis';

    protected $fillable = [
        'materi_id',
        'tipe',
        'isi',
        'link',
        'deskripsi',
        'durasi',
        'urutan',
    ];

    public function materi() {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function progressUser(){
        return $this->hasMany(ProgressKonten::class, 'konten_materi_id');
    }

    public function progress(){
        return $this->hasMany(Progress::class);
    }

    public function progressKonten(){
        return $this->hasMany(ProgressKonten::class);
    }
}
