<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index', [
        'user' => Auth::user()
    ]);
});

Route::get('/account/request', function () {
    return view('request_account');
});

Route::get('/forgot', function () {
    return view('forgot_password');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/reset/{token}', function (string $token) {
    return view('reset_password', [
        'token' => $token
    ]);
});

Route::post('/account/request', 'AccountController@create');
Route::post('/forgot', 'Auth\ForgotPasswordController@resetPassword');
Route::post('/login', 'Auth\LoginController@authenticate');
Route::post('/reset/{token}', 'Auth\ResetPasswordController@reset');
