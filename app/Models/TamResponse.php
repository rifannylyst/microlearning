<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TamResponse extends Model
{
    protected $table = 'tam_responses';

    protected $fillable = [
        'user_id',
        'perceived_usefulness',
        'perceived_ease_of_use',
        'behavioral_intention',
        'tanggal_respon',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
