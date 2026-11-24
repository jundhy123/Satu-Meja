<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::patch('/users/{user}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');
    Route::patch('/users/{user}/reject', [AdminController::class, 'rejectUser'])->name('users.reject');
    Route::patch('/users/{user}/suspend', [AdminController::class, 'suspendUser'])->name('users.suspend');
});
