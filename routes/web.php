<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
// Destinasi (User)
Route::get('/destinasi', [DestinasiController::class, 'userIndex'])->name('destinasi.index');
Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show');

// Paket Wisata (User)
Route::get('/paket_wisata', [PaketWisataController::class, 'userIndex'])->name('paket.index');
Route::get('/paket_wisata/{id}', [PaketWisataController::class, 'userShow'])->name('paket.show');

// Gallery (User)
Route::get('/gallery', [GalleryController::class, 'userIndex'])->name('gallery.index');
Route::get('/gallery/{id}', [GalleryController::class, 'userShow'])->name('gallery.show');

// Booking
Route::post('/booking/{paket}', [BookingController::class, 'store'])->name('booking.store');

// Contact
Route::get('/contact', fn() => view('user.contact'))->name('contact');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (prefix: admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Destinasi CRUD
    Route::resource('destinasi', DestinasiController::class);

    // Paket Wisata CRUD
    Route::resource('paket_wisata', PaketWisataController::class);

    // Gallery CRUD
    Route::resource('galleries', GalleryController::class);

    // Transaksi
    Route::resource('transaksi', TransaksiController::class);

    // Data Master
    Route::resource('data-masters', DataMasterController::class)->only(['index']);

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('transaksi', [LaporanController::class, 'transaksi'])->name('transaksi');
        Route::get('pendapatan', [LaporanController::class, 'pendapatan'])->name('pendapatan');
        Route::get('paket_wisata', [LaporanController::class, 'paketWisata'])->name('paket_wisata');
        Route::get('booking', [BookingController::class, 'laporan'])->name('booking');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('profile', [SettingController::class, 'profile'])->name('profile');
        Route::post('profile', [SettingController::class, 'updateProfile']);
        Route::get('password', [SettingController::class, 'password'])->name('password');
        Route::post('password', [SettingController::class, 'updatePassword']);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
});

