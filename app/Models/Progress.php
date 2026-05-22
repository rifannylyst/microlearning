<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Materi;

class Progress extends Model
{
    protected $table = 'progress';

    protected $fillable = [
        'user_id',
        'materi_id',
        'tipe',
        'status',
        'persentase',
        'last_accessed',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materi() {
        return $this->belongsTo(Materi::class, 'materi_id');
    }

    public function kontenMateri(){
        return $this->belongsTo(KontenMateri::class);
    }
}
