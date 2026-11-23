<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicDonationController;
use App\Http\Controllers\ClaimController;

// Halaman Beranda Satu Meja
Route::get('/', function () {
    $latestDonations = collect();
    $stats = [
        'total_donations' => 0,
        'claimed_donations' => 0,
        'verified_institutions' => 0,
    ];

    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('donations')) {
            $latestDonations = \App\Models\Donation::whereIn('status', ['available', 'urgent'])
                ->where('deadline', '>', now())
                ->latest()
                ->take(6)
                ->get();

            $stats['total_donations'] = \App\Models\Donation::count();
            $stats['claimed_donations'] = \App\Models\Donation::where('status', 'claimed')->count();
        }
        if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
            $stats['verified_institutions'] = \App\Models\User::where('is_verified', true)->count();
        }
    } catch (\Throwable $e) {
        // Handled gracefully
    }

    return view('home', compact('latestDonations', 'stats'));
})->name('home');

// Halaman Cari Donasi
Route::get('/donasi', [PublicDonationController::class, 'index'])->name('donations.index');

// Aksi Klaim
Route::post('/donasi/{donation}/klaim', [ClaimController::class, 'store'])
    ->middleware(['auth', 'verified.recipient'])
    ->name('donations.claim');

// Route login sementara (hapus nanti jika fitur Login sudah selesai)
Route::get('/login', function () {
    return 'Halaman Login (Belum dibuat)';
})->name('login');
