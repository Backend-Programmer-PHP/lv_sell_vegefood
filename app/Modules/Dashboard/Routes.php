<?php
//Dashboard routes
use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Dashboard', 'middleware' => 'web', 'namespace' => "App\Modules\Dashboard\Controllers"], function() {

    Route::get('dashboard', 'Dashboard@index')->name('dashboard');
    Route::group(["prefix" => "products"], function() {
        Route::get('/', 'Product@index')->name('product.index');
        Route::get('/add', 'Product@create')->name('product.create');
        Route::get('/trash', 'Product@trash')->name('product.trash');
        Route::get('/search', 'Product@search')->name('product.search');
        Route::get('/edit/{slug}', 'Product@edit')->name('product.edit');
        Route::post('/store', 'Product@store')->name('product.store');
        Route::post('/update/{slug}', 'Product@update')->name('product.update');
        Route::post('/delete/{slug}', 'Product@delete')->name('product.delete');
        Route::post('/trash/{slug}', 'Product@moveTrash')->name('product.move');
        Route::post('/rehibilitate/{slug}','Product@rehibilitate')->name('product.rehibilitate');
    });
    Route::group(["prefix" => "categories"], function() {
        Route::get('/', 'Category@index')->name('category.index');
        Route::get('/search', 'Category@search')->name('category.search');
        Route::get('/add', 'Category@create')->name('category.add');
        Route::get('/edit/{slug}', 'Category@edit')->name('category.edit');
        Route::post('/store', 'Category@store')->name('category.store');
        Route::post('/update/{id}', 'Category@update')->name('category.update');
        Route::post('/delete/{id}', 'Category@delete')->name('category.delete');
    });
    Route::group(["prefix" => "banners"], function() {
        Route::get('/', 'Banner@index')->name('banner.index');
        Route::get('/add', 'Banner@create')->name('banner.create');
        Route::get('/edit/{slug}', 'Banner@edit')->name('banner.edit');
        Route::post('/store', 'Banner@store')->name('banner.store');
        Route::post('/update/{slug}', 'Banner@update')->name('banner.update');
        Route::post('/delete/{slug}', 'Banner@delete')->name('banner.delete');
    });
});
