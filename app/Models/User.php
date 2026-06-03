<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserKelas;
use App\Models\Materi;
use App\Models\LogAktivitas;
use App\Models\Notifikasi;
use App\Models\TamResponse;
use App\Models\Progress;
use App\Models\HasilQuiz;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user_kelas() {
    return $this->hasMany(UserKelas::class, 'user_id');
}

public function materi() {
    return $this->hasMany(Materi::class, 'created_by');
}

public function log_aktivitas() {
    return $this->hasMany(LogAktivitas::class, 'user_id');
}

public function notifikasi() {
    return $this->hasMany(Notifikasi::class, 'user_id');
}

public function tam_responses() {
    return $this->hasMany(TamResponse::class, 'user_id');
}

public function progress() {
    return $this->hasMany(Progress::class);
}

public function progressKonten(){
    return $this->hasMany(ProgressKonten::class);
}

public function hasil_quiz() {
    return $this->hasMany(HasilQuiz::class);
}

public function isAdmin() {
    return $this->role === 'admin';
}

public function bookmarks() {
    return $this->hasMany(Bookmarks::class);
}

}
