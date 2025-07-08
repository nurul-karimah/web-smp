<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 5 user dummy + masing-masing 1 tagihan
        User::factory()->count(5)->create()->each(function ($user) {
            Pembayaran::create([
                'user_id' => $user->id,
                'jumlah_tagihan' => 450000,
                'tanggal_tagihan' => now(),
                'status_pembayaran' => 'BELUM',
            ]);
        });

        // Buat satu user test khusus
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Pastikan password di-hash
        ]);

        // Tambahkan data pembayaran untuk user test
            Pembayaran::create([
            'user_id' => $user->id,
            'jumlah_tagihan' => 450000,
            'tanggal_tagihan' => now(),
            'status_pembayaran' => 'LUNAS',
        ]);
    }
}
