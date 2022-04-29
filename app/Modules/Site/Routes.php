<?php
//Site routes
use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Site', 'middleware' => 'web', 'namespace' => "App\Modules\Site\Controllers"], function() {

    Route::get('welcome', 'Site@index')->name('home');

});
