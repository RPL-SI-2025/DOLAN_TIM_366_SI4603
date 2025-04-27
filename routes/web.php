<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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

    // Create Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

    // Profile
    Route::prefix('user/profile')->name('user.profile.')->middleware('auth')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});




    // Route::get('itineraries', [ItineraryController::class, 'index'])->name('itineraries.index')->middleware('auth');

    // Gallery
    // Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    // Route::resource('gallery', GalleryController::class);

});