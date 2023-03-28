<?php

use App\Http\Controllers\Frontend\StoreController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();

// Store Frontend
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as'        => 'front.',
    'middleware' => ['language', 'additional']
], function () {
    Route::get('/', 'StoreController@home')->name('home');
    Route::get('/store', 'StoreController@store')->name('store');
    Route::get('/cart', 'StoreController@showCart')->name('cart');
    Route::get('/store/{slug?}', 'StoreController@singleProduct')->name('single');
    Route::get('/category/{slug?}', 'StoreController@categoryList')->name('single_category');
    Route::get('/checkout', 'StoreController@showCheckout')->name('checkout')->middleware('auth');
    // Route::get('/checkout', 'StoreController@checkout')->name('checkout');
});

// Store Frontend Cart
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as' => 'cart.',
    'prefix' => 'cart'
], function () {
    Route::post('/add', 'CartController@addToCart')->name('add');
    Route::post('/remove', 'CartController@removeFromCart')->name('remove');
    Route::post('/calculateDelivery', 'CartController@calculateDelivery')->name('calculateDelivery');
    Route::get('/delete/{id}', 'CartController@deleteItemFromCart')->name('delete');
});

// Store Front end Order
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as' => 'order.',
    'prefix' => 'order',
    'middlewere' => ['auth']
], function () {
    Route::post('/store', 'OrderController@store')->name('store');
});

// Store Front end Auth
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as'        => 'auth.',
], function () {
    Route::get('/login', 'AuthController@show_login')->name('login')->middleware('guest');
    Route::post('/do_login', 'AuthController@do_login')->name('do_login');
    Route::get('/register', 'AuthController@show_register')->name('register')->middleware('guest');
    Route::post('/do_register', 'AuthController@do_register')->name('do_register');
    Route::get('/verify', 'AuthController@show_verify')->name('verify')->middleware('guest');
    Route::post('/do_phone_verification', 'AuthController@do_phone_verification')->name('do_phone_verification');
    Route::get('/set_password', 'AuthController@set_password')->name('set_password');
    Route::post('/do_set_password', 'AuthController@do_set_password')->name('do_set_password');
    Route::get('/forgot_password', 'AuthController@show_forgot')->name('forgot_password');
    Route::post('/do_forgot_password', 'AuthController@do_forgot_password')->name('do_forgot_password');
    Route::post('/logout', 'AuthController@logout')->name('logout');
});

// Store Frontend Profile
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as'        => 'profile.',
    'prefix'    => 'profile',
], function () {
    Route::get('/', 'ProfileController@index')->name('index');
    Route::post('/update', 'ProfileController@updateProfile')->name('update');
});

// store Frontend Invoice And Payment
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as'        => 'payment.',
    'prefix'    => 'payment',
    'middlewere' => ['auth']
], function () {
    Route::get('invoice/{order}', 'PaymentController@invoice')->name('invoice');
});


// Store Backend

Route::group([
    'namespace' => 'App\Http\Controllers\Backend',
    'as'        => 'admin.',
    'prefix'    => 'admin',
    'middlewere' => ['auth']
], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
});
