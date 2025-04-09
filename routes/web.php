<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registration')->middleware('guest');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration');