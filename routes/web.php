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



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard');

// // Halaman login
// Route::get('/', function () {
//     return view('auth.login');
// })->name('dsahboard');

// // Halaman dashboard
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->name('dashboard');

// Route::resource('destinasi', DestinasiController::class);

Route::resource('paket-wisata', PaketWisataController::class);

Route::resource('transaksi', TransaksiController::class);

Route::resource('data-masters', DataMasterController::class)->only(['index']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('galleries', GalleryController::class);
});

// route untuk wisatawan
Route::prefix('gallery')->name('user.gallery.')->group(function () {
    Route::get('/', [App\Http\Controllers\GalleryController::class, 'userIndex'])->name('index');
    Route::get('/{id}', [App\Http\Controllers\GalleryController::class, 'userShow'])->name('show');
});

Route::prefix('laporan')->group(function(){
    Route::get('transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');
});

Route::prefix('laporan')->group(function(){
    Route::get('transaksi', [LaporanController::class,'transaksi'])->name('laporan.transaksi');
    Route::get('pendapatan', [LaporanController::class,'pendapatan'])->name('laporan.pendapatan');
    Route::get('paket-wisata', [LaporanController::class,'paketWisata'])->name('laporan.paket_wisata');
});

Route::prefix('settings')->middleware('auth')->group(function(){
    Route::get('profile', [SettingController::class,'profile'])->name('settings.profile');
    Route::post('profile', [SettingController::class,'updateProfile']);
    Route::get('password', [SettingController::class,'password'])->name('settings.password');
    Route::post('password', [SettingController::class,'updatePassword']);
});

// Home
Route::get('/', [HomeController::class, 'index'])->name('user.home');
// Destinasi
// Route::get('/user/destinasi', [DestinasiController::class, 'userIndex'])->name('user.destinasi');
// Destinasi
// Route untuk ADMIN (CRUD)
Route::resource('destinasi', DestinasiController::class);

// Route untuk USER
// Route untuk USER
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/destinasi', [DestinasiController::class, 'userIndex'])->name('destinasi.index');
    Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show');
});



// Paket Wisata

// Route untuk USER (tanpa sidebar admin)
// Group route user
Route::prefix('user')->name('user.')->group(function () {
    // Daftar paket
    Route::get('/paket-wisata', [PaketWisataController::class, 'userIndex'])->name('paket.index');

    // Detail paket
    Route::get('/paket-wisata/{id}', [PaketWisataController::class, 'userShow'])->name('paket.show');
});
Route::post('/booking/{paket}', [BookingController::class, 'store'])->name('user.booking.store');
Route::get('/laporan/booking', [BookingController::class, 'laporan'])->name('laporan.booking');

// Route::prefix('user')->group(function () {
//     Route::get('/paket-wisata', [PaketWisataController::class, 'userIndex'])->name('user.paket.index');
//     Route::get('/paket-wisata/{id}', [PaketWisataController::class, 'userIndex'])->name('user.paket.show');
// });
// Route::get('/paket-wisata', [PaketWisataController::class, 'index'])->name('paket-wisata.index');
// Route::get('/paket-wisata/{id}', [PaketWisataController::class, 'show'])->name('paket-wisata.show');
// Contact
Route::get('/contact', function () {
    return view('user.contact');
})->name('user.contact');

// Route untuk admin
Route::resource('/admin/paket-wisata', PaketWisataController::class);
Route::get('/paket-wisata/{id?}', [PaketWisataController::class, 'index'])->name('paket-wisata.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
});

