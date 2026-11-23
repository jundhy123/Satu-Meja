<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicDonationController;
use App\Http\Controllers\ClaimController;

// Halaman Beranda (nanti kita isi tampilan Beranda Satu Meja)
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Cari Donasi
Route::get('/donasi', [PublicDonationController::class, 'index'])->name('donations.index');

// Aksi Klaim
Route::post('/donasi/{donation}/klaim', [ClaimController::class, 'store'])
    ->middleware(['auth', 'verified.recipient'])
    ->name('donations.claim');

// Route login sementara (hapus nanti kalau fitur Login dari temanmu sudah jadi)
Route::get('/login', function () {
    return 'Halaman Login (Belum dibuat)';
})->name('login');