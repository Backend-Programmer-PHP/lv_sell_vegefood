<?php
//Site routes
use Illuminate\Support\Facades\Route;
Route::group(['module' => 'Site', 'middleware' => 'web', 'namespace' => "App\Modules\Site\Controllers"], function() {

    Route::get('/', 'Site@index')->name('home');
    Route::group(["prefix" => "users"], function() {
        Route::get('/profile/{slug}', 'User@profile')->name('profile');
        Route::get('/signin', 'User@login')->name('login');
        Route::get('/signup', 'User@register')->name('register');
        Route::get('/forgot-password', 'User@forgotPassword')->name('forgot.password');
        Route::get('/lock', 'User@lock')->name('lock');
        Route::get('/error/{err}', 'User@error')->name('error');
        // POST
        Route::post('/signin/act', 'User@postLogin')->name('post.signin');
        Route::post('/signup/act', 'User@postSignUp')->name('signup');
        Route::post('/logout/act', 'User@postLogout')->name('logout');
        Route::post('/profile/{slug}/update', 'User@postUpdateAvatar')->name('update.photo');
        Route::post('/profile/{slug}/cover', 'User@postUpdateCover')->name('update.cover');
        Route::post('/profile/{slug}/personal', 'User@postUpdatePersonal')->name('update.personal');
    });

});
