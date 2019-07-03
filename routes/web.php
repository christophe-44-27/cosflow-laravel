<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', 'ApplicationController')->where('any', '.*');

Route::post('register', 'Auth\RegisterController@register');

