<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect(route('auth.login'));
});

Route::prefix('/auth')->group(function(){

    Route::get('/login', function(){
        return view('login');
    })->name('auth.login');
    
    Route::get('/register', function(){
        return view('register');
    })->name('auth.register');
});