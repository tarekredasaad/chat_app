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
    return view('login');
});

// Route::get('home', [ 'as' => 'home', 'uses' => 'App\Http\Controllers\HomeController@home'])->name('home');
// });

Route::get('signup', function () {
    return view('signup');
});

Route::post('signups','App\Http\Controllers\HomeController@signup');

Route::post('check_login','App\Http\Controllers\HomeController@check_login');

Route::get('messenger','App\Http\Controllers\MassengerController@index');

Route::get('messageuser/{userid}','App\Http\Controllers\MassengerController@create');

Route::post('send/{id}/{userid}','App\Http\Controllers\MassengerController@store');
