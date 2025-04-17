<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
<<<<<<< Updated upstream
    return view('welcome');
=======
    return view('user.welcome');
})->name('welcome');

// Halaman register
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');

// Halaman login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



// Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard utama
    Route::get('', function () {
        return view('dashboard.dashboard');
    })->name('index')->middleware('auth');

    // Destinasi Admin
    Route::get('destination', [DestinationController::class, 'index'])->name('destination.index')->middleware('auth');
    Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create')->middleware('auth');
    Route::post('destination', [DestinationController::class, 'store'])->name('destination.store')->middleware('auth');
    Route::get('destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit')->middleware('auth');
    Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update')->middleware('auth');
    Route::delete('destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy')->middleware('auth');
    
    // Create Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create')->middleware('auth');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store')->middleware('auth');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy')->middleware('auth');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit')->middleware('auth');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update')->middleware('auth');

    // Gallery
    // Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    // Route::resource('gallery', GalleryController::class);
>>>>>>> Stashed changes
});


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');