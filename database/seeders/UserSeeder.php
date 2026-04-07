<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Membuat Akun Admin (Untuk Login)
        User::create([
            'name' => 'Admin Perpus',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 2. Membuat 10 Akun Siswa Secara Otomatis menggunakan Factory
        // Ini akan menggunakan UserFactory yang kita buat di awal
        User::factory(10)->create([
            'role' => 'siswa'
        ]);

        $this->command->info('UserSeeder berhasil: 1 Admin dan 10 Siswa dibuat!');
    }
}
