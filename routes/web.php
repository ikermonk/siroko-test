<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', '\Siroko\App\Shop\Presentation\Controllers\ShopController@index')->name("shop");
Route::get('/cart', '\Siroko\App\Cart\Presentation\Controllers\CartController@index')->name("cart");

Route::post('/cart-add', '\Siroko\App\Cart\Presentation\Controllers\CartController@add')->name('cart.add');
Route::post('/cart-change', '\Siroko\App\Cart\Presentation\Controllers\CartController@change')->name('cart.change');
Route::post('/cart-update', '\Siroko\App\Cart\Presentation\Controllers\CartController@update')->name('cart.update');
Route::post('/cart-remove', '\Siroko\App\Cart\Presentation\Controllers\CartController@remove')->name('cart.remove');
Route::post('/cart-clear', '\Siroko\App\Cart\Presentation\Controllers\CartController@clear')->name('cart.clear');
Route::get('/checkout', '\Siroko\App\Cart\Presentation\Controllers\CartController@checkout')->name('checkout');
