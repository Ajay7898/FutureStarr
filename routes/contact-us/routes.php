<?php

/*
|--------------------------------------------------------------------------
| Web Routes Seller Dashboard
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'contact-us'], function () {
    Route::get('/', 'ContactUsController@index')->name('contact-us.index');
    Route::post('/store', 'ContactUsController@store')->name('contact-us.store');
    // Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');
});