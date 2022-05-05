<?php
//Site routes
use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Site', 'middleware' => 'web', 'namespace' => "App\Modules\Site\Controllers"], function() {

    Route::get('/', 'Site@index')->name('home');
    Route::group(["prefix" => "users"], function() {
        Route::get('/signin', 'User@login')->name('login');
        Route::get('/signup', 'User@register')->name('register');
        Route::get('/forgot-password', 'User@forgotPassword')->name('forgot.password');
        Route::get('/lock', 'User@lock')->name('lock');
        Route::get('/error/{err}', 'User@error')->name('error');
        // POST
        Route::post('/signup/act', 'User@signUpSubmit')->name('signup');
    });
});
