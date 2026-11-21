<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register.store');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.store');
    
Route::view('/register', 'auth.register')->name('register');

Route::view('/login', 'auth.login')->name('login');
