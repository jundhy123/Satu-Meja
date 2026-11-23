<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Pemberi Dummy
        $pemberi = User::firstOrCreate(
            ['email' => 'pemberi@satumeja.test'],
            [
                'name' => 'Resto Berkah Nusantara',
                'password' => Hash::make('password'),
                'role' => 'pemberi',
                'is_verified' => true,
            ]
        );

        // 2. Buat Akun Penerima Terverifikasi Dummy (untuk tes klaim nanti)
        User::firstOrCreate(
            ['email' => 'penerima@satumeja.test'],
            [
                'name' => 'Panti Asuhan Harapan',
                'password' => Hash::make('password'),
                'role' => 'penerima',
                'is_verified' => true,
            ]
        );

        // 3. Buat 3 Data Donasi Dummy
        Donation::create([
            'user_id' => $pemberi->id,
            'title' => 'Nasi Kotak Ayam Bakar',
            'description' => 'Sisa acara kantor, masih hangat, tersegel rapi dan layak konsumsi.',
            'food_type' => 'Makanan Berat',
            'quantity' => '25 Kotak',
            'location' => 'Jakarta Selatan',
            'pickup_address' => 'Jl. Sudirman No. 45, Gedung A Lantai 1',
            'pic_name' => 'Budi Santoso',
            'pic_contact' => '081234567890',
            'deadline' => now()->addHours(6),
            'status' => 'available',
        ]);

        Donation::create([
            'user_id' => $pemberi->id,
            'title' => 'Aneka Roti Manis & Croissant',
            'description' => 'Produksi pagi hari ini, kondisi sangat baik.',
            'food_type' => 'Roti & Kue',
            'quantity' => '30 Buah',
            'location' => 'Bandung',
            'pickup_address' => 'Jl. Dago No. 12, Toko Roti Manis',
            'pic_name' => 'Siti Aminah',
            'pic_contact' => '085678901234',
            'deadline' => now()->addHours(12),
            'status' => 'available',
        ]);

        Donation::create([
            'user_id' => $pemberi->id,
            'title' => 'Paket Sayur & Buah Segar',
            'description' => 'Sudah diambil oleh panti terdekat.',
            'food_type' => 'Bahan Makanan',
            'quantity' => '10 Paket',
            'location' => 'Surabaya',
            'pickup_address' => 'Jl. Darmo No. 88',
            'pic_name' => 'Andi Wijaya',
            'pic_contact' => '081998877665',
            'deadline' => now()->addDays(1),
            'status' => 'claimed',
        ]);
    }
}