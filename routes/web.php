<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// Route::get('/admin/home', 'HomeController@index')->name('admin.home');

Route::get('/', function () {
    return view('guest.welcome');
});

Route::middleware('auth')->get('{any?}', function () {
    return view('guest.films');
})->where('any', '.*');