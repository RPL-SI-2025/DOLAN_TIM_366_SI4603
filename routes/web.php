<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DestinationController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('user.welcome');
})->name('welcome');

// Halaman login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');

// Halaman register
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard utama
    Route::get('', function () {
        return view('dashboard.dashboard');
    })->name('index');

    // Destinasi
    Route::middleware('auth')->group(function () {
        Route::get('destination', [DestinationController::class, 'index'])->name('destination.index');
        Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create');
        Route::post('destination', [DestinationController::class, 'store'])->name('destination.store');
        Route::get('destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit');
        Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update');
        Route::delete('destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy');
    });
    
    // // Admin
    // Route::get('admin/download', [AdminController::class, 'download_pdf'])->name('admin.download_pdf');
    // Route::resource('admin', AdminController::class);
    //     Route::resource('gallery', GalleryController::class);
});

// Gallery
// Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
// Route::resource('gallery', GalleryController::class);
