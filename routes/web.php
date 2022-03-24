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

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/mypage', 'App\Http\Controllers\UserController@mypage')->name('mypage');
Route::get('user/mypage/edit', 'App\Http\Controllers\UserController@edit')->name('mypage.edit');
Route::get('user/mypage/address/edit', 'App\Http\Controllers\UserController@edit_address')->name('mypage.edit_address');
Route::put('user/mypage', 'App\Http\Controllers\UserController@update')->name('mypage.update');

Route::post('products/{product}/reviews', 'App\Http\Controllers\ReviewController@store');

Route::get('products/{product}/favorite', 'App\Http\Controllers\ProductController@favorite')->name('products.favorite');
Route::resource('products', 'App\Http\Controllers\ProductController');
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
