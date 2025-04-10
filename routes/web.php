<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
<<<<<<< Updated upstream
    return view('welcome');
=======
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

    Route::get('itineraries', [ItineraryController::class, 'index'])->name('itineraries.index')->middleware('auth');

    // Admin
    Route::get('admin/download', [AdminController::class, 'download_pdf'])->name('admin.download_pdf');
    Route::resource('admin', AdminController::class);

    // Gallery
    Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    Route::resource('gallery', GalleryController::class);

    // Destinasi Wisata - hanya untuk admin
    Route::middleware(['auth', 'is_admin'])->prefix('destinations')->name('destinations.')->group(function () {
        Route::get('/', [DestinationController::class, 'index'])->name('index');
        Route::get('/create', [DestinationController::class, 'create'])->name('create');
        Route::post('/', [DestinationController::class, 'store'])->name('store');
        Route::get('/{destination}/edit', [DestinationController::class, 'edit'])->name('edit');
        Route::put('/{destination}', [DestinationController::class, 'update'])->name('update');
        Route::delete('/{destination}', [DestinationController::class, 'destroy'])->name('destroy');
    });
>>>>>>> Stashed changes
});
