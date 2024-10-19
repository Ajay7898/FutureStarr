<?php

/*
|--------------------------------------------------------------------------
| Web Routes Talent Mall
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'talent-mall'], function () {
    Route::any('/', 'TalentMallController@index')->name('talent.index');

    Route::any('/ajax', 'TalentMallController@getTalentByCat')->name('search.ajax');
    Route::any('/show-more', 'TalentMallController@showMoreTalent')->name('show.more.talent');
    
    Route::any('/product-info/{id}', 'TalentMallController@productInfo')->name('talent.productInfo');
    Route::any('/give-talent-award', 'TalentMallController@giveTalentAward')->name('talent.give-award');
    Route::any('/add-rider', 'TalentMallController@addRiderToTalent')->name('talent.add-rider');
    Route::any('/add-buyer-contact-message', 'TalentMallController@addBuyerContactMessage')->name('talent.add-buyer-contact-message');
     Route::any('/add-talent-to-cart', 'TalentMallController@addTalentToCart')->name('talent.add-talent-to-cart');

     Route::any('/product-url', 'TalentMallController@productUrl')->name('talent.product-url');

     Route::match(['get', 'post'],'/search{id?}', 'TalentMallController@show')->name('talent.show');
});

