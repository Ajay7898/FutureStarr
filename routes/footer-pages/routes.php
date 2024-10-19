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
Route::get('/privacy-policy', 'PagesController@index')->name('privacy-policy');
Route::get('/term-conditions', 'PagesController@termsAndConditions')->name('term-conditions');
Route::get('/refund-policy', 'PagesController@refundPolicy')->name('refund-policy');

Route::get('/about-us', 'AboutusController@index')->name('about-us');
Route::get('/thank-you', 'ThankyouController@index')->name('thank-you');