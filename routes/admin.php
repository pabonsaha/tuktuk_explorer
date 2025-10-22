<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TourController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('banner')->name('banner.')->group(function () {
    Route::get('index', [BannerController::class, 'index'])->name('index');
    Route::post('store', [BannerController::class, 'store'])->name('store');
    Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
    Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
    Route::post('{id}/delete', [BannerController::class, 'destroy'])->name('delete');
});

Route::prefix('tours')->name('tours.')->group(function () {
    Route::get('index', [TourController::class, 'index'])->name('index');
    Route::post('store', [TourController::class, 'store'])->name('store');
    Route::get('{id}/edit', [TourController::class, 'edit'])->name('edit');
    Route::put('{id}/update', [TourController::class, 'update'])->name('update');
    Route::post('{id}/delete', [TourController::class, 'destroy'])->name('delete');
});
