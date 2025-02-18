<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Models\BookLoan;
use App\Models\Review;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect(route('books.index'));
});


Route::middleware('guest')->prefix('/auth')->group(function(){

    Route::controller(AuthController::class)->group(function(){

        Route::view('/login', 'auth.login')->name('auth.login');
    
        Route::post('/login', 'login')->name('login');
        
        Route::view('/register', 'auth.register')->name('auth.register');
    
        Route::post('/register', 'register')->name('register');
    });

    Route::prefix('/google')->controller(GoogleController::class)->group(function(){
    
        Route::get('', 'redirectToGoogle')->name('auth.google'); 
    
        Route::get('callback', 'handleGoogleCallback');
    });
});

Route::middleware('auth')->group(function(){

    Route::middleware('role:member')->controller(ReviewController::class)->name('reviews.')->prefix('reviews')->group(function(){

        Route::middleware('can:canAccessReview,review')->prefix('/{review}')->group(function(){
            Route::put('', 'update')->name('update');
            Route::delete('','destroy')->name('destroy');
        });

        Route::post('', 'store')->name('store');
    });

    Route::middleware('role:admin')->group(function(){

        Route::resource('settings', SettingController::class)
        ->only(['index', 'edit', 'update']);
    });

    Route::middleware('role:librarian,admin')->group(function(){
        Route::resource('users', UserController::class)
        ->only(['index']);
    
        Route::resource('books', BookController::class)
        ->except(['index', 'show']);

        Route::resource('book_loans', BookLoanController::class)
        ->except('destroy');
    });

    Route::controller(UserController::class)->middleware('can:isUserSelfOrAdminLibrarian,user')->group(function(){
        Route::get('users/{user}/book_loans', 'userBookLoans')
        ->name('users.book_loans');

        Route::resource('users', UserController::class)->only(['show', 'edit', 'update', 'destroy']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('notifications', NotificationController::class)
    ->only(['index', 'destroy']);
});

Route::prefix('/legal')->name('legal.')->group(function(){
    Route::view('privacy_policy', 'legal.privacy-policy')->name('privacy_policy');

    Route::view('terms_and_conditions', 'legal.terms-and-conditions')->name('terms_and_conditions');
});

Route::resource('books', BookController::class)
->only(['index', 'show']);

Route::post('/favorite/{book}', [FavoriteController::class, 'toggleFavorite'])
->name('users.toggle_favorite');