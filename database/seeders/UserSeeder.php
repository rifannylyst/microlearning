<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Ajat',
            'email' => 'ajat@gmail.com',
            'password' => 'ajat123',
            'role' => 'user',
        ]);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

    }
}
