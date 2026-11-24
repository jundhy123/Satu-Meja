<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicDonationController;

// 1. Halaman Beranda Utama Satu Meja (Interaktif Hello Monday Aesthetic)
Route::get('/', function () {
    $latestDonations = collect();
    $stats = [
        'total_donations' => 0,
        'claimed_donations' => 0,
        'verified_institutions' => 0,
    ];

    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('donations')) {
            $latestDonations = \App\Models\Donation::whereNull('claimed_by_user_id')
                ->whereNotIn('status', ['claimed', 'expired'])
                ->where('deadline', '>', now())
                ->latest()
                ->take(6)
                ->get();

            $stats['total_donations'] = \App\Models\Donation::count();
            $stats['claimed_donations'] = \App\Models\Donation::where('status', 'claimed')->orWhereNotNull('claimed_by_user_id')->count();
        }
        if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
            $stats['verified_institutions'] = \App\Models\User::where('is_verified', true)->orWhere('status', 'verified')->count();
        }
    } catch (\Throwable $e) {
        // Fallback safely
    }

    return view('home', compact('latestDonations', 'stats'));
})->name('home');

// 2. Public Donation Search & Detail
Route::get('/donasi', [PublicDonationController::class, 'index'])->name('donations.index');
Route::get('/api/donations/active', [PublicDonationController::class, 'activeJson'])->name('donations.json');

// 3. Load Modular Route Files (Sesuai Aturan Kerja Tim)
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/pendonasi.php';
require __DIR__ . '/penerima.php';
