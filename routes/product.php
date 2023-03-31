<?php

use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\EditProductController;
use App\Http\Controllers\Product\ProductListingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/products')->name('product.')->group(function () {
    Route::get('/', ProductListingController::class)->name('listing');
    Route::view('/create', 'product.create')->name('create');
    Route::post('/create', CreateProductController::class)->name('postCreate');
    Route::prefix('/{product}')->group(function () {
        Route::get('/edit', [EditProductController::class, 'get'])->name('edit');
        Route::post('/edit', [EditProductController::class, 'post'])->name('postEdit');
    });
});
