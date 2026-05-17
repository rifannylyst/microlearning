<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class materiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       \App\Models\materi::create([
        'judul' => 'Materi 1',
        'deskripsi' => 'Deskripsi materi 1',
        'urutan' => '1',
        'created_by' => 1,
       ]);
    }
}
