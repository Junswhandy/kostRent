<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\userKostController;
// Home Controller
use App\Http\Controllers\HomeController;

// Route untuk halaman awal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest'); // Hanya dapat diakses oleh pengguna tamu

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Register Routes
Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register')
    ->middleware('guest'); // Hanya dapat diakses oleh pengguna tamu

Route::post('register', [RegisteredUserController::class, 'store']);

// Password Reset Routes
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request')
    ->middleware('guest');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email')
    ->middleware('guest');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset')
    ->middleware('guest');

Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update')
    ->middleware('guest');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard'); // Tampilan dashboard Admin
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/user', function () {
        return view('user.dashboard'); // Tampilan dashboard User
    })->middleware('role:user')->name('user.dashboard');

    Route::get('/owner', function () {
        return view('owner.dashboard'); // Tampilan dashboard Pemilik
    })->middleware('role:owner')->name('owner.dashboard');
});


// admin role
Route::get('/admin/kost', [KostController::class, 'index'])->name('admin.kost');
Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');

// Route untuk menampilkan form edit user
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');

// Route untuk update data user
Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');

// Route untuk hapus user
Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
// untuk simpan data
Route::post('/admin/user', [UserController::class, 'store'])->name('admin.user.store');


// user role
// Route::get('/admin/user', [UserController::class, 'index'])->name('user.user');
// File: routes/web.php


// Route::get('/user/kost', [userKostController::class, 'showRentedKost'])->name('user.kost')->middleware('auth');
Route::get('/user/kost', [userKostController::class, 'showRentedKost'])->name('user.kost');
