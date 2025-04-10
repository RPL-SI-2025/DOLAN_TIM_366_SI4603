<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.welcome');
});

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard
    Route::get('', function () {
        return view('dashboard.dashboard');
    })->name('index');

    Route::get('itineraries', [ItineraryController::class, 'index'])->name('itineraries.index')->middleware('auth');
    
    // User Admin
    Route::get('admin/download', [AdminController::class, 'download_pdf'])->name('admin.download_pdf');
    Route::resource('admin', AdminController::class);


    // Gallery Admin
    Route::get('gallery/download', [GalleryController::class, 'download_pdf'])->name('gallery.download_pdf');
    Route::resource('gallery', GalleryController::class);
});