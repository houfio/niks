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

Route::post('/register', 'Auth\RegisterController@register')->middleware('can:create,App\User');
Route::post('/login', 'Auth\LoginController@login');

Route::delete('/advertisement/delete/{id}', 'AdvertisementController@delete');

Route::prefix('reset')->group(function () {
    Route::post('', 'Auth\ForgotPasswordController@forgotPassword');
    Route::view('', 'forgot_password');
    Route::post('{token}', 'Auth\ResetPasswordController@reset');
    Route::get('{token}', function (string $token) {
        return view('reset_password', [
            'token' => $token
        ]);
    });
});

Route::resource('users', 'UserController')->except([
    'create', 'store'
]);
