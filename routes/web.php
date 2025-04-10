<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PromoController;

Route::get('/destinations', [DestinationController::class, 'getDestinations'])->name('destinations.get');
Route::get('/promo', [PromoController::class, 'getPromo'])->name('promo.get');
Route::get('/', [HomeController::class, 'index']);




