<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ArtikelController;

Route::get('/artikel', [ArtikelController::class, 'index']);

// Halaman login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');

// Halaman register
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');

// Homepage
Route::get('/promo', [PromoController::class, 'getPromo'])->name('promo.get');
Route::get('/', [HomeController::class, 'index']);
Route::get('/destinations', [DestinationController::class, 'getDestinations'])->name('destinations.get');
// home setelah login
Route::get('/homeuser', function () {
    return view('homeuser');
})->middleware('auth')->name('homeuser');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard utama
    Route::get('', function () {
        return view('dashboard.dashboard');
    })->name('index');

    // Destinasi Admin
    Route::middleware('auth')->group(function () {
        Route::get('destination', [DestinationController::class, 'index'])->name('destination.index');
        Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create');
        Route::post('destination', [DestinationController::class, 'store'])->name('destination.store');
        Route::get('destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit');
        Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update');
        Route::delete('destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy');
    });
    
    // Create Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

    // Gallery
    // Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    // Route::resource('gallery', GalleryController::class);
});