<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// test("", function () {
Route::group(['as' => 'api.'], function () {

    require __DIR__ . '/Api/auth.php';

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/me', function () {
            return Auth::user(); 
        });
        require __DIR__ . '/Api/Product/products.php';
    });

});
