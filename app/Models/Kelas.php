<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserKelas;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'jurusan',
    ];

    public function user_kelas() {
        return $this->hasMany(UserKelas::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_kelas');
    }
}
