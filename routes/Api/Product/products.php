<?php

use App\Http\Controllers\Product\ProductsController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::apiResource('products', ProductsController::class);
  Route::put('products/{id}/restore', [ProductsController::class, 'restore'])->name('products.restore');
// });