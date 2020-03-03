<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();

    return redirect('/login');
});

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
