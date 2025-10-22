<?php

use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;


Route::prefix('banner')->name('banner.')->group(function () {
    Route::get('index', [BannerController::class, 'index'])->name('index');
    Route::post('store', [BannerController::class, 'store'])->name('store');
    Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
    Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
    Route::post('{id}/delete', [BannerController::class, 'destroy'])->name('delete');
});
