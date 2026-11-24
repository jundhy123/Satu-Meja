<?php

use App\Http\Controllers\PendonasiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:pendonasi,pemberi'])->prefix('pendonasi')->name('pendonasi.')->group(function () {
    Route::get('/dashboard', [PendonasiController::class, 'dashboard'])->name('dashboard');

    // Menerbitkan Donasi Baru (Memerlukan Akun Terverifikasi)
    Route::get('/donasi/create', [PendonasiController::class, 'create'])->name('donations.create');
    Route::post('/donasi', [PendonasiController::class, 'store'])->name('donations.store');
});
