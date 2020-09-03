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

Route::get('/', 'Client\AuthController@index')->middleware('guest');
Route::group([
    'prefix' => 'client',
], function () {
    Route::get('/dashboard', 'Client\AuthController@dashboard')->name('client.dashboard')->middleware('auth');
    Route::get('/dashboard/users', 'Client\ClientController@users')->name('client.dashboard.users')->middleware('auth');
    Route::get('/dashboard/venues', 'Client\ClientController@venues')->name('client.dashboard.venues')->middleware('auth');
    Route::get('/dashboard/adduser', 'Client\ClientController@adduser')->name('client.dashboard.adduser')->middleware('auth');
    Route::get('/dashboard/addvenues', 'Client\ClientController@addvenues')->name('client.dashboard.addvenues')->middleware('auth');
    Route::get('/dashboard/editprofile', 'Client\ClientController@editprofile')->name('client.dashboard.editprofile')->middleware('auth');
    Route::post('/dashboard/addvenues/store', 'Client\ClientController@storevenues')->name('client.dashboard.addvenue.store')->middleware('auth');
    Route::post('/dashboard/editprofile/store', 'Client\ClientController@storeprofile')->name('client.dashboard.editprofile.store')->middleware('auth');
    Route::post('/dashboard/adduser/store', 'Client\ClientController@store')->name('client.dashboard.adduser.store')->middleware('auth');
    Route::post('/register', 'Client\AuthController@store')
        ->name('client.register');
});
Route::auth('/login', 'Auth\LoginController');
Route::get('/logout', 'HomeController@logout');

Route::get('/home', 'HomeController@index')->name('home');
