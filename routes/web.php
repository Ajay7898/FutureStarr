<?php
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


//Auth::routes(['login' => false]);

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/sitemap', function() {
   return Response::view('sitemap')->header('Content-Type', 'application/xml');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/old', 'HomeController@oldhomepage')->name('old');
Route::post('/search-chat-users', 'HomeController@searchChatUsers')->name('search-chat-users');

Route::get('/approve-talent/{id}', 'HomeController@approveTalent')->name('approve.talent');
Route::get('/admin-talent-preview/{id}', 'HomeController@viewTalentForAdmin')->name('admin.talent.preview');


Route::group(['prefix' => 'buyer','middleware' => ['auth', 'buyer']], function () {
     Route::get('/shopping-cart', 'CartController@index')->name('cart.index');
     Route::get('/update-card', 'CartController@updateCard')->name('update.card');
     Route::post('/update-card', 'CartController@updateCard')->name('update.card.post');
     Route::post('/shopping-cart', 'CartController@index')->name('cart.index.post');
     Route::post('/deleteCartItem', 'CartController@deleteCartItem')->name('cart.delete-item');
});
  
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'PaymentController@postPaymentWithpaypal'));
Route::get('paypal', array('as' => 'payment.status','uses' => 'PaymentController@getPaymentStatus'));
Route::post('pay-with-stripe', array('as' => 'pay-with-stripe','uses' => 'PaymentController@payWithStripe'));

Route::get('paypal-payment-cancel', array('as' => 'payment.cancel','uses' => 'PaymentController@paymentCancel'));
Route::get('paypal-payment-success', array('as' => 'payment.success','uses' => 'PaymentController@paymentSuccess'));

Route::post('/image-upload', 'SellerController@imageUpload')->name('image-upload');

Route::get('/delete-account/', 'CommonuserController@index')->name('user.delete-account');
Route::post('/post-delete-account/', 'CommonuserController@deleteAccount')->name('delete-account');
Route::get('/talent-mail-to-buyers', 'CommonuserController@newAddedTalentMailToBuyers')->name('talent-mail-to-buyers');

Route::post('api/init-guest-chat', 'Admin\SupportChatGuestController@initGuestFront')->name('front.guest.chat.init');
Route::post('api/send/message/guest', 'Admin\SupportChatGuestController@store')->name('guest.chat.message.store');
Route::post('api/send/message/user', 'Admin\SupportChatGuestController@storeUser')->name('user.chat.message.store');
Route::get('api/get-unread-message/guest/{sender_id}', 'Admin\SupportChatGuestController@getUnreadMessagesGuest')->name('guest.chat.get.unread');
Route::get('api/get-unread-message/user/{sender_id}', 'Admin\SupportChatGuestController@getUnreadMessagesUser')->name('user.chat.get.unread');

Auth::routes();


Route::get('/load-latest-messages', 'MessagesController@getLoadLatestMessages')->name('load-latest-message');
Route::post('/send', 'MessagesController@postSendMessage')->name('send-message');
Route::post('/send/del', 'MessagesController@deleteMessage');
Route::get('/fetch-old-messages', 'MessagesController@getOldMessages')->name('old-message');



/*
|--------------------------------------------------------------------------
| Buyer and seller public profile route start.
|--------------------------------------------------------------------------
*/

Route::get('/buyer/{id}', 'PublicProfileController@index')->name('buyer-public-profile');
Route::get('/seller/{id}', 'PublicProfileController@create')->name('seller-public-profile');
Route::post('/profile-visitor', 'PublicProfileController@visitorProfile')->name('profile-visitor');


Route::group(['prefix' => 'message', 'middleware' => 'auth' ], function () {
        Route::post('/send', 'PublicProfileController@store')->name('public.profile.message.send');
});
Route::group(['prefix' => 'rider', 'middleware' => 'auth' ], function () {
        Route::post('/add', 'PublicProfileController@update')->name('public.profile.rider.add');
});
Route::group(['prefix' => 'user', 'middleware' => 'auth' ], function () {
        Route::post('/unfollow/{id}/{authid}', 'PublicProfileController@unfollowUser')->name('unfollow.user');
});
Route::group(['prefix' => 'favourite-user', 'middleware' => 'auth' ], function () {
        Route::post('/create/{id}', 'FavouriteUserController@index')->name('add-fav-user');
});

Route::group(['prefix' => 'notification', 'middleware' => 'auth' ], function () {
        Route::post('/send', 'FavouriteUserController@send_notification')->name('send-notification');
});


Route::group(['prefix' => 'chat-users', 'middleware' => 'auth' ], function () {
        Route::get('/', 'HomeController@users')->name('chat-users');
});

/*
|--------------------------------------------------------------------------
| Buyer and seller public profile route end
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'riders', 'middleware' => 'auth' ], function () {         
    Route::get('/', 'RidersController@index')->name('riders.index');
});

Route::post('/checkout', 'CartController@afterpayment')->name('checkout.credit-card');


Route::get('buyer-seller/chat-message/{id}', 'ChatMessageController@chat');
Route::get('buyer-seller/refresh-message/{lmi}/{rec}', 'ChatMessageController@refreshMessage');
Route::post('buyer-seller/chat-message', 'ChatMessageController@sendMessage');
Route::get('buyer-seller/inbox-message/{cond}', 'ChatMessageController@getInboxMessage');
Route::get('buyer-seller/getalluser', 'ChatMessageController@getAllUser');
Route::get('buyer-seller/getallreaduser', 'ChatMessageController@getAllReadMsg');
Route::get('buyer-seller/getallunreaduser', 'ChatMessageController@getAllUnreadMsg');
Route::get('buyer-seller/delete-message/{id}', 'ChatMessageController@deleteInboxMessage');
Route::post('buyer-seller/check-delete-message', 'ChatMessageController@checkDeleteInboxMessage');
Route::get('buyer-seller/auto-reply', 'ChatMessageController@sendAutoMessage');

