<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
// home setelah login
Route::get('/homeuser', function () {
    return view('homeuser');
})->middleware('auth')->name('homeuser');


//Artikel
Route::get('/articles', [ArticleController::class, 'publicIndex'])->name('articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard utama
    Route::get('', function () {
        return view('dashboard.dashboard');
    })->name('index')->middleware(['auth', 'role:admin,super_admin']);

    // Destinasi Admin
        Route::get('destination', [DestinationController::class, 'index'])->name('destination.index')->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create')->middleware(['auth', 'role:admin,super_admin']);
        Route::post('destination', [DestinationController::class, 'store'])->name('destination.store')->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit')->middleware(['auth', 'role:admin,super_admin']);
        Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update')->middleware(['auth', 'role:admin,super_admin']);
        Route::delete('destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy')->middleware(['auth', 'role:admin,super_admin']);
        Route::post('destination/remove-image', [DestinationController::class, 'removeImage'])->name('destination.removeImage')->middleware(['auth', 'role:admin,super_admin']);
    
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

    // Ticket
    Route::resource('tickets', TicketController::class)->middleware(['auth', 'role:admin,super_admin']);

});
    // Profile
    Route::prefix('user/profile')->name('user.profile.')->middleware('auth')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});



Route::get('destinations', [DestinationController::class, 'showAllDestinations'])->name('destination.index');
Route::get('destinations/{id}', [DestinationController::class, 'showDestination'])->name('destinations.show');

// Ticket Purchase
Route::get('/tickets-for-sale', [TicketController::class, 'showAvailableTickets'])->name('tickets.available')->middleware('auth');
Route::post('/purchase/ticket/{ticket}', [OrderController::class, 'purchaseTicket'])->name('purchase.ticket')->middleware('auth');

// New route for showing the ticket booking form for a specific destination
Route::get('/booking/destination/{destination}', [TicketController::class, 'showTicketBookingPage'])->name('booking.show_ticket_form')->middleware('auth');

// Midtrans 
Route::get('/payment/checkout/{order}', [PaymentController::class, 'createTransaction'])->name('payment.checkout')->middleware('auth');
Route::get('/payment/finish/{order}', [PaymentController::class, 'paymentFinish'])->name('payment.finish')->middleware('auth');
Route::post('/payment/notifications', [PaymentController::class, 'notificationHandler'])->name('payment.notification'); // This should be an open route for Midtrans
