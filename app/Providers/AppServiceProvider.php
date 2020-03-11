<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)/', $value);
        });

        Validator::extend('zip_code', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-zA-Z]{2}$/', $value);
        });
    }
}
