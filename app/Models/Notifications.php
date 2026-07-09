<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable = [
        'user_id',
        'tipe',
        'judul',
        'pesan',
        'reference_type',
        'reference_id',
        'is_read',
    ];
}
