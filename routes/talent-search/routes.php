<?php

/*
|--------------------------------------------------------------------------
| Web Routes Star search
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'star-search'], function () {
    Route::get('/{slug?}', 'SearchController@index')->name('search.index');
    //Route::get('/about/{id}/{title?}', 'SearchController@show')->name('search.show');
});

Route::post('/search', 'TalentSearchController@index')->name('search');