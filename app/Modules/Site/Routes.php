<?php
//Site routes
use Illuminate\Support\Facades\Route;
Route::group(['module' => 'Site', 'middleware' => 'web', 'namespace' => "App\Modules\Site\Controllers"], function() {

    Route::get('/', 'Site@index')->name('home');
    Route::get('/about', 'Site@about')->name('about');
    Route::get('/contact-us', 'Site@contact')->name('contact');
   // URL/users/...
    Route::group(["prefix" => "users"], function() {
        // Middleware:
        Route::group(['middleware'=>['verify']],function () {
            Route::get('/profile/{slug}', 'User@profile')->name('profile');
        });
        // Route::get('/profile/{slug}', 'User@profile')->name('profile');
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
    // URL/shop/...
    Route::group(["prefix" => "shop"], function() {
        Route::get('/', 'Shop@index')->name('shop');
        Route::get('/{slug}', 'Shop@productCategory')->name('product.category');
        Route::get('/product/{slug}', 'Shop@productDetalSlug')->name('product.detail');
        // Middleware:
        Route::group(['middleware' => ['verify'], "prefix" => "favorites" ],function () {
            Route::get('/list', 'Shop@getFavorites')->name('product.favorite');
            Route::post('/action/{id}', 'Shop@addAndDeleteFavorite')->name('product.favorite.add');
        });
    });
    // URL/blog/...
    Route::group(["prefix" => "blog"], function() {
        Route::get('/', 'Blog@index')->name('blog');
        Route::get('/blog-single', 'Blog@getBlogSingle')->name('blog.single');
    });
    // URL/orders/...
    Route::group(["prefix" => "orders",'middleware' => ['verify']], function() {
        Route::get('/cart', 'Order@index')->name('cart');
        Route::get('/filter/city', 'Order@filterRegion')->name('city.ajax');
        Route::get('/add/{slug}', 'Order@addToCart')->name('cart.add');
        Route::get('/delete/{id}', 'Order@deleteToCart')->name('cart.delete');
        Route::post('/cart/update', 'Order@updateToCart')->name('cart.update');
        Route::post('/cart/coupon', 'Order@applyCouponIntoOrders')->name('cart.coupon');
        Route::post('/cart/shipping', 'Order@estimateShippingCharges')->name('cart.shipping');
    });
    // URL/checkout/...
    Route::group(["prefix" => "checkout", 'middleware' => ['verify']], function() {
        Route::get('/', 'Checkout@getCheckout')->name('checkout');
        Route::post('/billing', 'Checkout@postBillingOrder')->name('checkout.billing');
    });
    Route::get('/send-notification', 'Announcement@sendOfferNotification');


});
