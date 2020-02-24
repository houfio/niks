<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/account/request', function () {
    return view('request_account');
});

Route::post('/account/request', 'AccountController@create');
