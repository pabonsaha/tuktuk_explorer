<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TourAdditionalController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourHourController;
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
    Route::get('create', [TourController::class, 'create'])->name('create');
    Route::post('store', [TourController::class, 'store'])->name('store');
    Route::get('{id}/edit', [TourController::class, 'edit'])->name('edit');
    Route::patch('{id}/update', [TourController::class, 'update'])->name('update');

    Route::post('{id}/delete', [TourController::class, 'destroy'])->name('delete');
    Route::post('{id}/delete', [TourController::class, 'delete'])->name('delete');
    Route::post('/admin/tours/{tour}/toggle', [TourController::class, 'toggleStatus'])->name('toggle');
});

Route::prefix('tour/{id}/hour')->name('tour.hour.')->group(function () {
    Route::get('index', [TourHourController::class, 'index'])->name('index');
    Route::post('store', [TourHourController::class, 'store'])->name('store');
    Route::get('{tour_id}/edit', [TourHourController::class, 'edit'])->name('edit');
    Route::post('{tour_id}/update', [TourHourController::class, 'update'])->name('update');
    Route::post('{tour_id}/delete', [TourHourController::class, 'destroy'])->name('delete');
});

Route::prefix('tour/{id}/additional')->name('tour.additional.')->group(function () {
    Route::get('index', [TourAdditionalController::class, 'index'])->name('index');
    Route::post('store', [TourAdditionalController::class, 'store'])->name('store');
    Route::get('{tour_id}/edit', [TourAdditionalController::class, 'edit'])->name('edit');
    Route::post('{tour_id}/update', [TourAdditionalController::class, 'update'])->name('update');
    Route::post('{tour_id}/delete', [TourAdditionalController::class, 'destroy'])->name('delete');
});
