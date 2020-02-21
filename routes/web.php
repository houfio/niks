<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/account/request', function () {
    return view('request_account');
});

Route::post('/account/request', 'AccountController@create');
