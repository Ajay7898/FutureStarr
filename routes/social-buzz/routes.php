<?php

/*
|--------------------------------------------------------------------------
| Web Routes Social Buzz 
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'social-buzz'] , function () {
    Route::get('/{catId?}', 'SocialBuzzController@index')->name('social-buzz.index');
    //Route::get('/{blogId}', 'SocialBuzzController@index')->name('social-buzz.index');
    Route::post('/store', 'SocialBuzzController@store')->name('social-buzz.store');
    Route::get('/comments/{postid?}', 'SocialBuzzController@getSocilaBuzzComments')->name('social-buzz.comments');
    Route::get('/awards/{postid?}', 'SocialBuzzController@getSocialBuzzAwards')->name('social-buzz.awards');
    Route::get('/riders/{postid?}', 'SocialBuzzController@getSocialBuzzRiders')->name('social-buzz.riders');
    

    Route::post('/storeComments', 'SocialBuzzController@postSocialBuzzComments')->name('social-buzz.storeComments');
    Route::post('/storeAward', 'SocialBuzzController@postBuzzAward')->name('social-buzz.storeAward');
    Route::post('/storeRider', 'SocialBuzzController@postBuzzRider')->name('social-buzz.storeRider');
    Route::post('/reportUser', 'SocialBuzzController@reportUser')->name('social-buzz.reportUser');
    Route::post('/add-ad-views', 'SocialBuzzController@addCommercialAdviews')->name('social-buzz.add-ad-views');
    Route::post('/check-product-link', 'SocialBuzzController@checkProductLink')->name('social-buzz.check-product-link');

   Route::post('/edit-scoial-buzz', 'SocialBuzzController@update')->name('edit-scoial-buzz');
    
}); 