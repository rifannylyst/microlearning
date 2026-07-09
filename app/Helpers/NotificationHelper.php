<?php

namespace App\Helpers;

use App\Models\Notifications;

class NotificationHelper
{
    public static function create(
        $userId,
        $tipe,
        $judul,
        $pesan,
        $referenceType = null,
        $referenceId = null
    ) {

        Notifications::create([
            'user_id' => $userId,
            'tipe' => $tipe,
            'judul' => $judul,
            'pesan' => $pesan,
            'reference_type' => $referenceType,
            'reference_id' => $referenceId,
        ]);
    }
}