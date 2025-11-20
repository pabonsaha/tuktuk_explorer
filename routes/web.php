<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::name('tour.')->prefix('tour')->group(function () {
    Route::get('{slug}', [TourController::class, 'details'])->name('details');
});

Route::name('pay.')->prefix('pay')->group(function () {
    Route::post('/stripe', [PaymentController::class, 'payStripe'])->name('stripe');
    Route::get('/success', [PaymentController::class, 'successPayment'])->name('success');
    Route::get('/error', [PaymentController::class, 'errorPayment'])->name('error');
    Route::get('/send-email', [PaymentController::class, 'sendBookingConfirmationEmail'])->name('send-email');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('storage:link');

    return 'Cache cleared!';
});


require __DIR__ . '/auth.php';
