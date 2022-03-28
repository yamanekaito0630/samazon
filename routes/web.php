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
Route::delete('users/mypage/delete', 'App\Http\Controllers\UserController@destroy')->name('mypage.destroy');

Route::post('products/{product}/reviews', 'App\Http\Controllers\ReviewController@store');

Route::get('products/{product}/favorite', 'App\Http\Controllers\ProductController@favorite')->name('products.favorite');
Route::get('products', 'App\Http\Controllers\Dashboard\ProductController@index')->name('products.index');
Route::get('products/{product}', 'App\Http\Controllers\Dashboard\ProductController@show')->name('products.show');
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware('auth:admins');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('login', 'App\Http\Controllers\Dashboard\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'App\Http\Controllers\Dashboard\Auth\LoginController@login')->name('login');
    Route::resource('major_categories', 'App\Http\Controllers\Dashboard\MajorCategoryController')->middleware('auth:admins');
    Route::resource('categories', 'App\Http\Controllers\Dashboard\CategoryController')->middleware('auth:admins');
    Route::resource('products', 'App\Http\Controllers\Dashboard\ProductController')->middleware('auth:admins');
    Route::resource('users', 'App\Http\Controllers\Dashboard\UserController')->middleware('auth:admins');
});

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
