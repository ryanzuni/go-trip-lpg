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
// Booking
Route::post('/booking/{paket}', [BookingController::class, 'store'])
    ->name('booking.store');

// ⬇️ TAMBAHKAN INI
Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])
    ->name('booking.payment');

Route::post('/booking/{paket}', [BookingController::class, 'store'])->name('booking.store');

// Contact
Route::get('/contact', function () {
    $comments = \App\Models\Comment::whereNull('parent_id')->approved()->latest()->paginate(10);
    return view('user.contact', compact('comments'));
})->name('contact');
Route::post('/contact', [App\Http\Controllers\CommentController::class, 'store'])->name('contact.store');

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

    // Comments Management
    Route::get('comments', [App\Http\Controllers\CommentController::class, 'index'])->name('comments.index');
    Route::post('comments/{id}/approve', [App\Http\Controllers\CommentController::class, 'approve'])->name('comments.approve');
    Route::post('comments/{id}/reject', [App\Http\Controllers\CommentController::class, 'reject'])->name('comments.reject');
    Route::delete('comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

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

