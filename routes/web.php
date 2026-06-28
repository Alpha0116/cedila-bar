<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccueilControleur;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;

use App\Http\Controllers\RestaurantControleur;
use App\Http\Controllers\BarControleur;

use App\Http\Controllers\AdminMenuControleur;
use App\Http\Controllers\AdminEvenementControleur;

Route::get('/', [AccueilControleur::class, 'index'])->name('accueil');
Route::get('/restaurant', [RestaurantControleur::class, 'index'])->name('restaurant.accueil');
Route::get('/bar', [BarControleur::class, 'index'])->name('bar.accueil');
Route::post('/evenements/{id}/like', [BarControleur::class, 'like'])->name('evenements.like');

Auth::routes();

// Client routes
Route::middleware(['auth'])->group(function () {
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

    // Espace client
    Route::get('/mes-commandes', [\App\Http\Controllers\UserController::class, 'index'])->name('user.orders.index');
    Route::get('/mes-commandes/{id}', [\App\Http\Controllers\UserController::class, 'showOrder'])->name('user.orders.show');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Commandes & Réservations
    Route::get('/orders', [AdminController::class, 'ordersIndex'])->name('orders.index');
    Route::post('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.update');
    
    Route::get('/reservations', [AdminController::class, 'reservationsIndex'])->name('reservations.index');
    Route::post('/reservations/{reservation}/status', [AdminController::class, 'updateReservationStatus'])->name('reservations.update');
    
    // Menus & Boissons
    Route::resource('menus', AdminMenuControleur::class);
    
    // Evénements
    Route::resource('evenements', AdminEvenementControleur::class);
});
