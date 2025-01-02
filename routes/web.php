<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\BookLoan;
use App\Models\Review;
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

Route::middleware('auth')->group(function(){

    Route::middleware('role:member')->controller(ReviewController::class)->group(function() {

        Route::middleware('can:canAccessReview,review')->group(function(){
            Route::put('reviews/{review}', 'update')->name('reviews.update');
            Route::delete('reviews/{review}','destroy')->name('reviews.destroy');
        });

        Route::post('reviews', 'store')->name('reviews.store');
    });

    Route::middleware('role:librarian,admin')->group(function(){
        Route::resource('users', UserController::class)
        ->only(['index']);
    
        Route::resource('books', BookController::class)
        ->except(['index', 'show']);

        Route::resource('book_loans', BookLoanController::class)
        ->except(['show', 'destroy']);
    });

    Route::controller(UserController::class)->middleware('can:isUserSelfOrAdminLibrarian,user')->group(function(){
        Route::get('users/{user}/book_loans', 'userBookLoans')
        ->name('users.book_loans');

        Route::resource('users', UserController::class)->only(['show', 'edit', 'update', 'destroy']);
    });

    Route::get('/notifications', [UserController::class, 'showNotifications'])
    ->name('users.notifications');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::prefix('/legal')->group(function(){
    Route::view('privacy_policy', 'legal.privacy_policy')->name('legal.privacy_policy');

    Route::view('terms_and_conditions', 'legal.terms_and_conditions')->name('legal.terms_and_conditions');
});

Route::resource('books', BookController::class)
->only(['index', 'show']);
