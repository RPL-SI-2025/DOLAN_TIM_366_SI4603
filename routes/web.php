<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
// use App\Http\Controllers\GalleryController;

// Halaman register
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');

// Halaman login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

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
    })->name('index')->middleware(['auth', 'role:admin,super_admin']);

    // Destinasi Admin
    Route::middleware('auth')->group(function () {
        Route::get('destination', [DestinationController::class, 'index'])->name('destination.index')->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create')->middleware(['auth', 'role:admin,super_admin']);
        Route::post('destination', [DestinationController::class, 'store'])->name('destination.store')->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit')->middleware(['auth', 'role:admin,super_admin']);
        Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update')->middleware(['auth', 'role:admin,super_admin']);
        Route::delete('destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy')->middleware(['auth', 'role:admin,super_admin']);
    });
    
    // Create Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth', 'role:super_admin']);
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create')->middleware(['auth', 'role:super_admin']);
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store')->middleware(['auth', 'role:super_admin']);
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy')->middleware(['auth', 'role:super_admin']);
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit')->middleware(['auth', 'role:super_admin']);
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update')->middleware(['auth', 'role:super_admin']);

     // Article
     Route::get('articles', [ArticleController::class, 'index'])->name('articles.index')->middleware(['auth', 'role:admin,super_admin']);
     Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware(['auth', 'role:admin,super_admin']);
     Route::post('articles', [ArticleController::class, 'store'])->name('articles.store')->middleware(['auth', 'role:admin,super_admin']);
     Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware(['auth', 'role:admin,super_admin']);
     Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit')->middleware(['auth', 'role:admin,super_admin']);
     Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware(['auth', 'role:admin,super_admin']);
   
     // Gallery
    // Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    // Route::resource('gallery', GalleryController::class);
});

