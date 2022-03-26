<?php

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

Route::get('/', 'App\Http\Controllers\WebController@index');
Route::get('users/carts', 'App\Http\Controllers\CartController@index')->name('carts.index');

Route::post('users/carts', 'App\Http\Controllers\CartController@store')->name('carts.store');

Route::delete('users/carts', 'App\Http\Controllers\CartController@destroy')->name('carts.destroy');

Route::get('users/mypage', 'App\Http\Controllers\UserController@mypage')->name('mypage');
Route::get('users/mypage/edit', 'App\Http\Controllers\UserController@edit')->name('mypage.edit');
Route::get('users/mypage/address/edit', 'App\Http\Controllers\UserController@edit_address')->name('mypage.edit_address');
Route::put('users/mypage', 'App\Http\Controllers\UserController@update')->name('mypage.update');
Route::get('users/mypage/favorite', 'App\Http\Controllers\UserController@favorite')->name('mypage.favorite');
Route::get('users/mypage/password/edit', 'App\Http\Controllers\UserController@edit_password')->name('mypage.edit_password');
Route::put('users/mypage/password', 'App\Http\Controllers\UserController@update_password')->name('mypage.update_password');

Route::post('products/{product}/reviews', 'App\Http\Controllers\ReviewController@store');

Route::get('products/{product}/favorite', 'App\Http\Controllers\ProductController@favorite')->name('products.favorite');
Route::resource('products', 'App\Http\Controllers\ProductController');
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
