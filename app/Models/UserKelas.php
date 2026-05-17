<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kelas;

class UserKelas extends Model
{
    protected $fillable = [
        'user_id',
        'kelas_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}
