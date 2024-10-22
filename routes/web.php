<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PostController@index')->name('home');
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

Route::prefix('setup')->group(function () {
    Route::get('password/{user}', 'Auth\ForgotPasswordController@sendPasswordSetupMail')->middleware('can:edit-all');
    Route::get('{token}', function (string $token) {
        return view('setup_password', [
            'token' => $token
        ]);
    })->name('setup_password');
});

Route::resource('users', 'UserController')->except([
    'create', 'store'
]);

Route::put('users/approve/{user}', 'Auth\ApproveController@approve');

Route::resource('advertisements', 'AdvertisementController');

Route::resource('posts', 'PostController')->except([
    'index', 'show'
]);

Route::resource('categories', 'CategoryController')->except([
    'show'
]);

Route::resource('tickets', 'TicketController');

Route::resource('interviews', 'InterviewController')->except([
    'edit', 'update'
]);

Route::get('interviews/accept/{interview}/{token}', 'InterviewController@accept');

Route::prefix('ticket')->group(function () {
    Route::get('{ticket}/{token}', 'TicketController@respond')->name('ticket_respond');
    Route::post('{ticket}/{token}', 'TicketController@reply');
});

Route::resource('favorites', 'UserFavoritesController')->except([
    'create', 'show', 'edit', 'update'
]);

Route::resource('transactions', 'TransactionController')->except([
    'create', 'edit', 'update', 'destroy'
]);

Route::prefix('bid')->group(function () {
    Route::post('{advertisement}', 'BidController@store');
    Route::delete('{bid}', 'BidController@destroy');
});
