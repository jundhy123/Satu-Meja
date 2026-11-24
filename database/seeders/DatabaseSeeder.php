<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@satumeja.id'],
            [
                'name' => 'Admin Pengelola Satu Meja',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'verified',
                'institution_name' => 'Pengelola Satu Meja',
                'category' => 'Admin Platform',
                'pic_name' => 'Jundhy NR Situmorang',
                'phone' => '081234567890',
                'address' => 'Institut Teknologi Del, Laguboti, Toba',
            ]
        );

        // 2. Pendonasi Terverifikasi (Siap mempublikasikan donasi)
        User::updateOrCreate(
            ['email' => 'pendonasi@satumeja.id'],
            [
                'name' => 'Restoran Melati Berkah',
                'password' => Hash::make('password123'),
                'role' => 'pendonasi',
                'status' => 'verified',
                'institution_name' => 'PT Melati Kuliner Indonesia',
                'category' => 'Restoran',
                'pic_name' => 'Budi Santoso',
                'phone' => '081399887766',
                'address' => 'Jl. Sisingamangaraja No. 12, Laguboti',
            ]
        );

        // 3. Pendonasi Pending (Menunggu Verifikasi)
        User::updateOrCreate(
            ['email' => 'bakery@satumeja.id'],
            [
                'name' => 'Toko Roti Sedap Roso',
                'password' => Hash::make('password123'),
                'role' => 'pendonasi',
                'status' => 'pending',
                'institution_name' => 'CV Sedap Roso Bakery',
                'category' => 'Toko Roti',
                'pic_name' => 'Siti Aminah',
                'phone' => '085211223344',
                'address' => 'Jl. Merdeka No. 45, Balige',
            ]
        );

        // 4. Penerima Terverifikasi (Siap mengklaim donasi)
        User::updateOrCreate(
            ['email' => 'penerima@satumeja.id'],
            [
                'name' => 'Panti Asuhan Kasih Ibu',
                'password' => Hash::make('password123'),
                'role' => 'penerima',
                'status' => 'verified',
                'institution_name' => 'Yayasan Kasih Ibu Toba',
                'category' => 'Panti Asuhan',
                'pic_name' => 'Drs. Herman Simanjuntak',
                'phone' => '081266554433',
                'address' => 'Jl. Tarutung No. 88, Balige',
            ]
        );

        // 5. Penerima Pending
        User::updateOrCreate(
            ['email' => 'dapur@satumeja.id'],
            [
                'name' => 'Dapur Umum Peduli Sesama',
                'password' => Hash::make('password123'),
                'role' => 'penerima',
                'status' => 'pending',
                'institution_name' => 'Komunitas Peduli Toba',
                'category' => 'Dapur Umum',
                'pic_name' => 'Maria Siregar',
                'phone' => '081377889900',
                'address' => 'Jl. Pelabuhan No. 5, Porsea',
            ]
        );

        // 6. Akun Rejected (Ditolak)
        User::updateOrCreate(
            ['email' => 'rejected@satumeja.id'],
            [
                'name' => 'Akun Palsu Fiktif',
                'password' => Hash::make('password123'),
                'role' => 'pendonasi',
                'status' => 'rejected',
                'institution_name' => 'Usaha Tidak Jelas',
                'category' => 'Lainnya',
                'pic_name' => 'Anonim',
                'phone' => '0800000000',
                'address' => 'Alamat Fiktif',
            ]
        );
    }
}
