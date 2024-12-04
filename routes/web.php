<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect(route('books.index'));
});


Route::middleware('guest')->prefix('/auth')->group(function(){

    Route::controller(AuthController::class)->group(function(){

        Route::get('/login', 'loginForm')->name('auth.login');
    
        Route::post('/login', 'login')->name('login');
        
        Route::get('/register', 'registerForm')->name('auth.register');
    
        Route::post('/register', 'register')->name('register');
    });

    Route::prefix('/google')->controller(GoogleController::class)->group(function(){
    
        Route::get('', 'redirectToGoogle')->name('auth.google');
    
        Route::get('callback', 'handleGoogleCallback');
    });
});

Route::resource('books', BookController::class)
->only(['index', 'show']);

Route::resource('user', UserController::class)
->only(['show']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')
->name('logout');

Route::get('user/{user}', [UserController::class, 'show'])->middleware('auth')->name('user.show');