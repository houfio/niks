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

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Auth::logout();
    return view('login');
});

Route::post('/account/request', 'AccountController@create');
Route::post('/login', 'Auth\LoginController@authenticate');
