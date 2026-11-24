<?php

use App\Http\Controllers\PenerimaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:penerima'])->prefix('penerima')->name('penerima.')->group(function () {
    Route::get('/dashboard', [PenerimaController::class, 'dashboard'])->name('dashboard');

    // Aksi Klaim Donasi (Memerlukan Akun Terverifikasi)
    Route::post('/donasi/{donation}/klaim', [PenerimaController::class, 'claim'])->name('donations.claim');

    // Kirim Ucapan Terima Kasih
    Route::post('/thank-you', [PenerimaController::class, 'sendThankYou'])->name('thankyou.store');
});
