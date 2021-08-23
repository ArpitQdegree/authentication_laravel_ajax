<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;

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

Route::get('register', 'App\Http\Controllers\RegisterController@register');

Route::post('save_user','App\Http\Controllers\RegisterController@save_user');

//login

Route::get('login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('user_login', 'App\Http\Controllers\LoginController@user_login');



Route::group(['middleware' => 'auth.user'], function(){
    Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');
    //logout
    Route::get('/logout', 'App\Http\Controller\LoginController@logout')->name('logout');
    // Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');
    // Route::get('/logout', 'App\Http\Controller\LoginController@logout')->name('logout');
});
