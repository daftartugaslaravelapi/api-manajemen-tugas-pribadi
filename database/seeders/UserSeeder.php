<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat satu pengguna
        $user = User::create([
            'name' => 'Jihan',
            'no_hp' => '081234567890',
            'email' => 'jihan@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Buat 3 tugas untuk pengguna
        Task::create([
            'user_id' => $user->id,
            'judul' => 'Selesaikan Laporan Proyek',
            'deskripsi' => 'Rangkum semua progres proyek hingga minggu ini.',
            'status_selesai' => false,
        ]);

        Task::create([
            'user_id' => $user->id,
            'judul' => 'Belajar Laravel',
            'deskripsi' => 'Memahami cara membuat data dummy untuk database.',
            'status_selesai' => true,
        ]);

        Task::create([
            'user_id' => $user->id,
            'judul' => 'Beli Kebutuhan Bulanan',
            'deskripsi' => 'Cek daftar belanjaan di catatan.',
            'status_selesai' => false,
        ]);
    }
}
