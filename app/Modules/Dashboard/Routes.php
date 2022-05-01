<?php
//Dashboard routes
use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Dashboard', 'middleware' => 'web', 'namespace' => "App\Modules\Dashboard\Controllers"], function() {

    Route::get('dashboard', 'Dashboard@index')->name('dashboard');
    Route::group(["prefix" => "products"], function() {
        Route::get('/', 'Product@index')->name('product.index');
    });
    Route::group(["prefix" => "categories"], function() {
        Route::get('/', 'Category@index')->name('category.index');
        Route::get('/add', 'Category@create')->name('category.add');
        Route::get('/edit/{slug}', 'Category@edit')->name('category.edit');
        Route::post('/store', 'Category@store')->name('category.store');
        Route::post('/update/{id}', 'Category@update')->name('category.update');
        Route::get('/delete/{id}', 'Category@delete')->name('category.delete');
    });

});
