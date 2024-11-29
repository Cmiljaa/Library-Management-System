<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
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

Route::middleware('role:member')->get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

Route::prefix('auth/google')->controller(GoogleController::class)->group(function(){
    
    Route::get('', 'redirectToGoogle')->name('auth.google');

    Route::get('callback', 'handleGoogleCallback');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')
->name('logout');