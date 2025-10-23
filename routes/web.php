<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
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
    } elseif ($user->role === 'mahasiswa') {
        // Mahasiswa diarahkan ke halaman dashboard mahasiswa
        return view('student.dashboard'); // pastikan file view-nya ada: resources/views/student/dashboard.blade.php
    }

    // Default fallback (jika role tidak dikenali)
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// CRUD Buku (hanya admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class);
});

// CRUD BOOK
// Route::get('/books', [BookController::class, 'index'])->name('books.index');
// Route::resource('books', BookController::class);

// Profile route (semua user bisa edit profilnya)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
