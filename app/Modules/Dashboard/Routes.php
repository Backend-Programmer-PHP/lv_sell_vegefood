<?php
//Dashboard routes
use Illuminate\Support\Facades\Route;

Route::group(['module' => 'Dashboard', 'middleware' => 'web', 'namespace' => "App\Modules\Dashboard\Controllers"], function() {

    Route::get('dashboard', 'Dashboard@index')->name('dashboard');
    // URL/products..
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
    // URL/categories..
    Route::group(["prefix" => "categories"], function() {
        Route::get('/', 'Category@index')->name('category.index');
        Route::get('/search', 'Category@search')->name('category.search');
        Route::get('/add', 'Category@create')->name('category.add');
        Route::get('/edit/{slug}', 'Category@edit')->name('category.edit');
        Route::post('/store', 'Category@store')->name('category.store');
        Route::post('/update/{id}', 'Category@update')->name('category.update');
        Route::post('/delete/{id}', 'Category@delete')->name('category.delete');
    });
    // URL/banners..
    Route::group(["prefix" => "banners"], function() {
        Route::get('/', 'Banner@index')->name('banner.index');
        Route::get('/add', 'Banner@create')->name('banner.create');
        Route::get('/edit/{slug}', 'Banner@edit')->name('banner.edit');
        Route::post('/store', 'Banner@store')->name('banner.store');
        Route::post('/update/{slug}', 'Banner@update')->name('banner.update');
        Route::post('/delete/{slug}', 'Banner@delete')->name('banner.delete');
    });
    // URL/coupons..
    Route::group(["prefix" => "coupons"], function() {
        Route::get('/', 'Coupon@index')->name('coupon.index');
        Route::get('/add', 'Coupon@create')->name('coupon.create');
        Route::get('/edit/{id}', 'Coupon@edit')->name('coupon.edit');
        Route::post('/store', 'Coupon@store')->name('coupon.store');
        Route::post('/update/{id}', 'Coupon@update')->name('coupon.update');
        Route::post('/delete/{id}', 'Coupon@delete')->name('coupon.delete');
    });
    // URL/notifications..
    Route::group(["prefix" => "notifications"], function() {
        Route::get('/', 'Notification@index')->name('notification.index');
        Route::get('/{id}', 'Notification@showNotification')->name('notification.show');
        Route::post('/remove/{id}', 'Notification@delete')->name('notification.delete');
    });
    // URL/orders..
    Route::group(["prefix" => "orders"], function() {
        Route::get('/', 'Notification@showOrder')->name('order.show');
    });
});
