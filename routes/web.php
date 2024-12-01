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
use App\Http\Controllers\KonfirmasiBayarController;


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

    // Route::get('/user', function () {
    //     return view('user.dashboard'); // Tampilan dashboard User
    // })->middleware('role:user')->name('user.dashboard');

    // Rute untuk halaman dashboard owner
    Route::get('/owner', action: [KostController::class, 'index'])
        ->middleware('role:owner') // Menambahkan middleware untuk hanya akses role owner
        ->name('owner.dashboard'); // Nama rute untuk dashboard owner


    Route::get('/user', action: [KostController::class, 'indexUser'])
        ->middleware('role:user') // Menambahkan middleware untuk hanya akses role owner
        ->name('user.dashboard'); // Nama rute untuk dashboard user
});


// admin role
Route::get('/admin/kost', [KostController::class, 'indexAdmin'])->name('admin.kost');

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


// owner role
Route::get('/owner/kost', [KostController::class, 'index1'])->name('kost.index1');

// Route untuk form tambah kost
Route::get('/owner/kost/create', [KostController::class, 'create'])->name('kost.create');

// Route untuk menyimpan data kost baru
Route::post('/owner/kost', [KostController::class, 'store'])->name('kost.store');

// Route untuk form edit kost
Route::get('/owner/kost/{id}/edit', [KostController::class, 'edit'])->name('kost.edit');

// Route untuk update data kost
Route::put('/owner/kost/{id}', [KostController::class, 'update'])->name('kost.update');

Route::delete('/kost/{kost}', [KostController::class, 'destroy'])->name('kost.destroy');
// Menampilkan detail kost berdasarkan ID
Route::get('/owner/kost/{id}', [KostController::class, 'show'])->name('owner.kost.show');

Route::get('/owner/user', [UserController::class, 'index'])->name('owner.user');


// user

Route::get('/user/kost/{id}', [KostController::class, 'showUser'])->name('user.kost.show');
use App\Http\Controllers\BookingController;

Route::post('/user/kost/booking', [BookingController::class, 'store'])->name('booking.store');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/konfirmasi', [KonfirmasiBayarController::class, 'index'])->name('konfirmasi.index');
    Route::post('/konfirmasi/upload', [KonfirmasiBayarController::class, 'upload'])->name('konfirmasi.upload');
    Route::post('/konfirmasi/bayar', [KonfirmasiBayarController::class, 'store'])->name('konfirmasi.store');
});
Route::get('/user/kost-saya', [userKostController::class, 'showRentedKost'])->name('user.kost');

// Rute untuk melihat daftar booking
Route::get('/owner/bookings', [BookingController::class, 'index'])->name('owner.booking.index');

// Rute untuk konfirmasi booking (Setujui)
Route::post('/owner/booking/confirm', [BookingController::class, 'confirm'])->name('owner.booking.confirm');

// Rute untuk menolak booking
Route::post('/owner/booking/reject', [BookingController::class, 'reject'])->name('owner.booking.reject');


// route filtering