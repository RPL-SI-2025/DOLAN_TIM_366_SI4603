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
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
// use App\Http\Controllers\GalleryController;
use App\Http\Controllers\WishlistController;


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
        Route::get('destination/{destination}/ratings', [RatingController::class, 'byDestination'])
            ->name('destination.ratings')
            ->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/create', [DestinationController::class, 'create'])->name('destination.create')->middleware(['auth', 'role:admin,super_admin']);
        Route::post('destination', [DestinationController::class, 'store'])->name('destination.store')->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit')->middleware(['auth', 'role:admin,super_admin']);
        Route::put('destination/{id}', [DestinationController::class, 'update'])->name('destination.update')->middleware(['auth', 'role:admin,super_admin']);
        Route::delete('destination/{id}', [DestinationController::class, 'destroy'])->name('destination.destroy')->middleware(['auth', 'role:admin,super_admin']);
        Route::post('destination/remove-image', [DestinationController::class, 'removeImage'])->name('destination.removeImage')->middleware(['auth', 'role:admin,super_admin']);
        Route::get('destination/{id}', [DestinationController::class, 'show'])->name('destination.show')->middleware(['auth', 'role:admin,super_admin']);

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

    // Merchandise
    Route::get('merchandise', [MerchandiseController::class, 'index'])->name('merchandise.index')->middleware(['auth', 'role:admin,super_admin']);
    Route::get('merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create')->middleware(['auth', 'role:admin,super_admin']);
    Route::post('merchandise', [MerchandiseController::class, 'store'])->name('merchandise.store')->middleware(['auth', 'role:admin,super_admin']);
    Route::get('merchandise/{merchandise}/edit', [MerchandiseController::class, 'edit'])->name('merchandise.edit')->middleware(['auth', 'role:admin,super_admin']);
    Route::put('merchandise/{merchandise}', [MerchandiseController::class, 'update'])->name('merchandise.update')->middleware(['auth', 'role:admin,super_admin']);
    Route::delete('merchandise/{merchandise}', [MerchandiseController::class, 'destroy'])->name('merchandise.destroy')->middleware(['auth', 'role:admin,super_admin']);

    // Ticket
    Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    // Ratings
    Route::get('ratings', [RatingController::class, 'index'])->name('ratings.index')->middleware(['auth', 'role:admin,super_admin']);
    Route::get('ratings/{rating}', [RatingController::class, 'show'])->name('ratings.show')->middleware(['auth', 'role:admin,super_admin']);
    Route::delete('ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy')->middleware(['auth', 'role:admin,super_admin']);
});

// User Ratings
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('ratings', [RatingController::class, 'index'])->name('ratings.index');
    Route::get('destinations/{destination}/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('destinations/{destination}/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('ratings/{rating}', [RatingController::class, 'show'])->name('ratings.show');
    Route::get('ratings/{rating}/edit', [RatingController::class, 'edit'])->name('ratings.edit');
    Route::put('ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update');

    //Order List
    Route::get('/my-orders', [OrderController::class, 'userOrders'])->name('orders');
    Route::get('/my-orders/{id}', [OrderController::class, 'userOrderDetail'])->name('orders.show');
});

    

    // Profile
    Route::prefix('user/profile')->name('user.profile.')->middleware('auth')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    
    // Badges
        Route::get('/badges', [BadgeController::class, 'index'])->name('badges.index');
        Route::get('/badges/create', [BadgeController::class, 'create'])->name('badges.create');
        Route::post('/badges/store', [BadgeController::class, 'store'])->name('badges.store');
        Route::get('/badges/{id}/edit', [BadgeController::class, 'edit'])->name('badges.edit');
        Route::put('/badges/{id}', [BadgeController::class, 'update'])->name('badges.update');
        Route::delete('/badges/{id}', [BadgeController::class, 'destroy'])->name('badges.destroy');
    });




Route::get('destinations', [DestinationController::class, 'showAllDestinations'])->name('destination.index');
Route::get('destinations/{id}', [DestinationController::class, 'showDestination'])->name('destinations.show');

// Purchase Order
Route::post('/tickets/{ticket}/purchase', [OrderController::class, 'purchaseTicket'])->name('tickets.purchase')->middleware('auth');
Route::get('/booking/destination/{destination}', [TicketController::class, 'showTicketBookingPage'])->name('tickets.show_ticket_form')->middleware('auth');
Route::get('/orders', [OrderController::class, 'showOrder'])->name('orders.index')->middleware('auth');

// Midtrans 
Route::get('/payment/checkout/{order}', [PaymentController::class, 'createTransaction'])->name('payment.checkout')->middleware('auth');
Route::get('/payment/finish/{order}', [PaymentController::class, 'paymentFinish'])->name('payment.finish')->middleware('auth');
Route::post('/payment/notification', [PaymentController::class, 'notificationHandler'])->name('payment.notification');

//Wishlist
Route::middleware('auth')->get('wishlist', [WishlistController::class, 'show'])->name('wishlist.show');
Route::middleware('auth')->post('wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::middleware('auth')->delete('wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

//Merchandise
Route::get('/merchandise', [MerchandiseController::class, 'publicIndex'])->name('merchandise.index');
Route::get('/merchandise/{merchandise}', [MerchandiseController::class, 'publicShow'])->name('merchandise.show');
Route::get('/merchandise/{merchandise}/purchase', [MerchandiseController::class, 'showPurchaseForm'])->name('merchandise.purchase_form');
Route::post('/merchandise/{merchandise}/purchase', [OrderController::class, 'purchaseMerchandise'])->name('merchandise.purchase')->middleware('auth');

//crowdsourcing
Route::post('/user/destinations/store', [DestinationController::class, 'store'])->name('user.destinations.store');
Route::get('/user/destinations/create', [DestinationController::class, 'createForUser'])
     ->middleware('auth')
     ->name('user.destinations.create');

Route::patch('/dashboard/destinations/update-status/{id}', [DestinationController::class, 'updateStatus'])
     ->middleware('auth')
     ->name('dashboard.destination.updateStatus');

Route::get('/dashboard/destinations/pending', function () {
    return view('dashboard.destination.pending');
})->middleware('auth')->name('dashboard.destination.pending');

Route::get('/user/destinations', [DestinationController::class, 'userDestinations'])
    ->middleware('auth')
    ->name('user.destinations.index');
