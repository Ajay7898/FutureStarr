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
    Route::get('/', 'TalentMallContoller@index')->name('talent.index');

    Route::post('/ajax', 'TalentMallContoller@getTalentByCat')->name('search.ajax');
    Route::get('/product-info/{id}', 'TalentMallContoller@productInfo')->name('talent.productInfo');
    Route::post('/give-talent-award', 'TalentMallContoller@giveTalentAward')->name('talent.give-award');
    Route::post('/add-rider', 'TalentMallContoller@addRiderToTalent')->name('talent.add-rider');
    Route::post('/add-buyer-contact-message', 'TalentMallContoller@addBuyerContactMessage')->name('talent.add-buyer-contact-message');
     Route::post('/add-talent-to-cart', 'TalentMallContoller@addTalentToCart')->name('talent.add-talent-to-cart');

     Route::get('/product-url', 'TalentMallContoller@productUrl')->name('talent.product-url');

     Route::match(['get', 'post'],'/{id?}', 'TalentMallContoller@show')->name('talent.show');
});

