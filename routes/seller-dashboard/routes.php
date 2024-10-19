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
Route::group(['prefix' => 'seller','middleware' => ['auth', 'seller']], function () {
    Route::get('/dashboard', 'SellerController@index')->name('seller.index');
    // Products
    Route::resource('/product', 'ProductController')->except(['update', 'destroy']);

    Route::get('/add-product', 'SellerController@addProduct')->name('seller.add-product');

    Route::post('/store-product', 'SellerController@storeProduct')->name('seller.store-product');

    /***********************  SELLER COMMERCIAL ADS ******************************/

    Route::get('/commercial-ads', 'SellerController@commercialAds')->name('seller.commercialAds');
    Route::get('/commercial-ad-dashboard', 'SellerController@commercialAdDashboard')->name('seller.commercial-ads-dashboard');

   Route::get('/add-commercial-ad', 'SellerController@addCommercilaAds')->name('seller.addCommercilaAds');
   Route::post('/store-commercial-ad', 'SellerController@storeCommercialAd')->name('seller.storeCommercialAd');

    Route::post('/post-seller-contact', 'SellerController@postSellerContact')->name('seller.post-seller-contact');
    Route::post('/custom-plan', 'SellerController@postCustomPlan')->name('seller.custom-plan');
    Route::get('/sale', 'SellerController@sellerSale')->name('seller.seller-sale');
    Route::any('/my-product/{days?}/{filter?}', 'SellerController@SellerProducts')->name('seller.my-product');
    Route::get('/my-deleted-product/{days?}/{filter?}', 'SellerController@getSellerDeletedProduct')->name('seller.my-deleted-product');
    Route::post('/my-deleted-product-undo', 'SellerController@deleteMyProductUndo')->name('seller.bulk-deleted-my-product-undo');
    Route::post('/bulk-deleted-my-product-permanently', 'SellerController@deleteMyProductPermanently')->name('seller.bulk-deleted-my-product-permanently');
    Route::post('/delete-my-product', 'SellerController@deleteMyProduct')->name('seller.delete-my-product');
    Route::post('/bulk-delete-my-product', 'SellerController@bulkDeleteProducts')->name('seller.bulk-delete-my-product');
    Route::get('/edit-product/{id}', 'SellerController@editProduct')->name('seller.edit-product');
    Route::post('/update-product', 'SellerController@updateProduct')->name('seller.update-product');

    /************ SELLLER PROFILE EDIT **********************/

    Route::get('/account-setting', 'SellerController@edit')->name('seller.edit');
    Route::get('/seller-profile', 'SellerController@profile')->name('seller.profile');
	
    Route::post('/update-account-setting', 'SellerController@update')->name('seller.update');
    Route::get('/change-password', 'SellerController@changePassword')->name('seller.changePassword');
    Route::post('/set-buyer-password', 'SellerController@setPassword')->name('seller.setPassword');
	Route::get('/message', 'SellerController@chatMessagees')->name('seller.chatMessagees');

   /****** PROMOTE PRODUCTS ROUTES START *************/

    Route::get('/promote-product/{days?}/{filter?}', 'SellerController@getPromoteProduct')->name('seller.promote-product');
    Route::post('/post-promote-product', 'SellerController@postPromoteProduct')->name('seller.post-promote-product');
    Route::get('/promote-product-update', 'SellerController@getPromoteProductToUpdate')->name('seller.promote-product-update');
    Route::post('/edit-promote-product', 'SellerController@editPromoteProduct')->name('seller.edit-promote-product');
    Route::post('/delete-promote-product', 'SellerController@deletePromoteProduct')->name('seller.delete-promote-product');

  /****** PROMOTE PRODUCTS ROUTES END*************/
  
  /************** Billing page *************/
  Route::get('/account-info', 'SellerController@accountinfo')->name('seller.accountinfo');
  /************** Billing page End *************/

  /************** STRIPE API CONTROLLER ROUTES ********************/

   Route::get('/stripe-connect', 'StripeController@index');
   Route::get('/seller-paypal-payment-success', 'PaymentController@paypalPaymentSuccessMethod')->name('seller.paypalSuccess');
   Route::get('/seller-paypal-payment-cancel', 'PaymentController@paypalPaymentCancelMethod')->name('seller.paypalCancel');

   Route::get('/support-chat', 'Admin\SupportChatController@frontIndex')->name('seller.support.chat');
   Route::get('api/support-chat/send-msg', 'Admin\SupportChatController@store')->name('seller.support.chat.send');
   Route::get('api/get-unread/{receiver_id}/{sender_id}', 'Admin\SupportChatController@getUnreadMessages')->name('seller.chat.get.unread');
   Route::post('api/send/message', 'Admin\SupportChatController@store')->name('seller.chat.message.store');


    Route::get('/public-profile', 'SellerController@public_profile')->name('seller.public.profile');
    Route::post('/store-public-profile', 'SellerController@public_profile_store')->name('seller.public.profile.store');

});
