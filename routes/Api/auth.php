<?php


use Illuminate\Support\Facades\Route;

Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
  Route::post('/register', \App\Http\Controllers\Auth\RegisterController::class)->name('register');
  Route::post('/login', \App\Http\Controllers\Auth\LoginController::class)->name('login');
});
