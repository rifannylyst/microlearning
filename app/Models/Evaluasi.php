<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $fillable = ['judul', 'deskripsi'];

    public function soal()
    {
        return $this->hasMany(SoalEvaluasi::class);
    }

    public function hasil()
    {
        return $this->hasMany(HasilEvaluasi::class);
    }
}
