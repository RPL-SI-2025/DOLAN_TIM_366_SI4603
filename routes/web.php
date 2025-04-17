<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;


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








    // Article
    Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    
});
