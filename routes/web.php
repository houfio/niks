<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome', [
        'user' => Auth::user()
    ]);
});

Route::get('/account/request', function () {
    return view('request_account');
});

Route::get('/reset', function () {
    return view('reset_password');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::post('/account/request', 'AccountController@create');
Route::post('/reset', 'Auth\ForgotPasswordController@resetPassword');
Route::post('/login', 'Auth\LoginController@authenticate');
