<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect(route('auth.login'));
});

Route::prefix('/auth')->controller(AuthController::class)->group(function(){

    Route::get('/login', 'loginForm')->name('auth.login');

    Route::post('/login', 'login')->name('login');
    
    Route::get('/register', 'registerForm')->name('auth.register');

    Route::post('/register', 'register')->name('register');
});