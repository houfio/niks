<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');
Route::view('/register', 'register');
Route::view('/login', 'login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::post('/register', 'Auth\RegisterController@register')->middleware('can:create,App\User');
Route::post('/login', 'Auth\LoginController@login');

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

Route::put('users/approve/{user}', 'Auth\ApproveController@approve');

Route::resource('advertisements', 'AdvertisementController')->except([
    'edit', 'update'
]);

Route::prefix('bid')->group(function () {
    Route::post('{advertisement}', 'BidController@store');
    Route::delete('{bid}', 'BidController@destroy');
});
