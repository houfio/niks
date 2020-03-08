<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/reset', function () {
    return view('forgot_password');
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

Route::get('/reset/{token}', function (string $token) {
    return view('reset_password', [
        'token' => $token
    ]);
});

Route::post('/reset', 'Auth\ForgotPasswordController@forgotPassword');
Route::post('/reset/{token}', 'Auth\ResetPasswordController@reset');
