<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk Hash password

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Gede Mahedra Sastra Adhi Wiguna',
            'email' => 'hendrasastra027@gmail.com',
            'password' => Hash::make('040506'), // Ganti password ini
            'role' => 'admin',
            'whatsapp' => '081234567890',
            'angkatan' => '2023',
            'is_approved' => true,
        ]);
    }
}