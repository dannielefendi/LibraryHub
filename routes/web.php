<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        // Admin diarahkan ke halaman Books
        return redirect()->route('books.index');
    } elseif ($user->role === 'user') {
        // User diarahkan ke halaman dashboard user
        return redirect()->route('user.dashboard'); // pastikan file view-nya ada: resources/views/user/dashboard.blade.php
    }

    // Default fallback (jika role tidak dikenali)
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// CRUD Buku (hanya admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class);
});

// dashboard user
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/dashboard', [BorrowingController::class, 'index'])->name('user.dashboard');
    Route::post('/user/borrow', [BorrowingController::class, 'store'])->name('user.borrow');
    Route::get('/user/my-borrowings', [BorrowingController::class, 'showUserBorrowings'])->name('user.borrowings');
});


// Profile route (semua user bisa edit profilnya)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
