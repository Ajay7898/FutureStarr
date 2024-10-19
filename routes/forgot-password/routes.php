<?php

/*
|--------------------------------------------------------------------------
| Web Routes Forgot password
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/forgot-password', 'ForgotPasswordController@index')->name('forgot-password');
Route::get('/reset_password/{any}', 'ForgotPasswordController@resetPassword')->name('reset_password');
Route::post('/updatePassword', 'ForgotPasswordController@updatePassword')->name('password.update11');