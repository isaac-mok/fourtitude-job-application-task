<?php

use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\ProductListingController;
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

Route::redirect('/', '/products');
Route::prefix('/products')->name('product.')->group(function () {
    Route::get('/', ProductListingController::class)->name('listing');
    Route::view('/create', 'product.create')->name('create');
    Route::post('/create', CreateProductController::class)->name('postCreate');
});
