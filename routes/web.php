<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController; // Controller untuk lupa password
use App\Http\Controllers\Auth\NewPasswordController; // Controller untuk reset password
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Permintaan;
use App\Http\Controllers\RegDosenController;
use App\Http\Controllers\RoomController; // Tambahkan controller untuk ruangan
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

// Redirect default route to login page
Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/ruangan/request', [RequestController::class, 'store'])->name('request.store');

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/ruangan', [AdminController::class, 'ruangan'])->name('ruangan');
    Route::put('/ruangan.update/{id}', [RuanganController::class, 'update'])->name('ruangan.update');

    Route::put('permintaan.terima/{id}', [Permintaan::class, 'terima'])->name('permintaan.terima');
    Route::put('permintaan.tolak/{id}', [Permintaan::class, 'tolak'])->name('permintaan.tolak');
    Route::resource('reg_dosen', RegDosenController::class);
    Route::get('admin.riwayat', [AdminController::class, 'riwayat'])->name('admin.riwayat');
});

Route::prefix('dosen')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');

    // Rute untuk menampilkan daftar ruangan
    Route::get('/ruangan', [RoomController::class, 'index'])->name('dosen.ruangan');

    // Rute untuk mengambil ruangan
    Route::post('/ambil', [RoomController::class, 'ambil'])->name('dosen.ambil');

    Route::resource('permintaan', Permintaan::class);
});

Route::post('/dosen/take-room', [DosenController::class, 'takeRoom'])->name('dosen.take-room');

// Rute untuk Login, Register, dan Logout
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    // Register routes
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Lupa password
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Reset password
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rute untuk Dashboard (Hanya untuk pengguna terautentikasi)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
