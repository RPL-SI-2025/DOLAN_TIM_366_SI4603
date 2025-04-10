<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;

// Halaman login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');

// Halaman register
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard utama
    Route::get('', function () {
        return view('dashboard.dashboard');
    })->name('index');

    Route::get('itineraries', [ItineraryController::class, 'index'])->name('itineraries.index')->middleware('auth');

    // Admin
    Route::get('admin/download', [AdminController::class, 'download_pdf'])->name('admin.download_pdf');
    Route::resource('admin', AdminController::class);

    // Gallery
    Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    Route::resource('gallery', GalleryController::class);
});
