<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// Route::group([
//     'middleware' => 'auth',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('register', 'Api\UserController@register');
//     Route::post('login', 'Api\UserController@login');
//     Route::post('logout', 'Api\UserController@logout');
//     Route::post('refresh', 'Api\UserController@refresh');
//     Route::get('profile', 'Api\UserController@profile');

// });


// Route::group(['middleware' => ['api-access'], 'prefix' => '/v1'], function () {
Route::group(['prefix' => '/v1'], function () {
    // User Registeration Process All Steps Routes
    Route::post('/user/login', 'Api\UserController@authenticate');

    /* Signup though facebook */
    Route::post('/user/facebook_register', 'Api\UserController@socialUserRegister');
    Route::post('/user/linkedin_register', 'Api\UserController@socialUserRegister');

    Route::get('/trending-list/{userid}', 'Api\PublicProfileController@getTrendingsList');
    Route::get('/similar-product-list/{userid}', 'Api\PublicProfileController@getSimilarProductList');
    
    Route::get('/public-profile/{userid}/profile', 'Api\PublicProfileController@sellerPublicProfile');
    Route::post('/user', 'Api\UserController@register');
    
    Route::get('/verify/{token}', 'Api\UserController@verifyUser');  
    Route::post('/user/forgot-password', 'Api\PasswordController@forgotPassword');
    Route::get('/forgot/validate-url/{token}', 'Api\PasswordController@validateURL');
    Route::post('/user/reset-password', 'Api\PasswordController@setNewUserPasswordRq');

    // Talent open Api routes

    Route::get('/futurestarr/marketplace', 'Api\TalentCategoryController@futureStarrMarketplace');
    
    Route::get('/category/{id}/detail', 'Api\TalentCategoryController@categoryById');
    Route::post('/contact-us', 'Api\TalentCategoryController@contactus');
    
    /*************** ******************************/
    Route::get('/talents/{slug}/category', 'Api\TalentCategoryController@talentsByCategory');
    Route::get('/talents/{slug}/product-info', 'Api\TalentCategoryController@productByCategory');
    
    /*************** ******************************/
    //Social Buzz API's
    Route::get('/social-buzz/{categoryId}/listing', 'Api\SocialBuzzController@socialBuzz');
    Route::get('/blogs/{catId?}', 'Api\BlogController@blogs');
    Route::get('/blogs/{category}/{blogId}', 'Api\BlogController@blogById');

    Route::get('/social-buzz-awards/{postId}/listing', 'Api\SocialBuzzController@getSocialBuzzAwards');
    Route::get('/social-buzz-riders/{postId}/listing', 'Api\SocialBuzzController@getSocailBuzzRiders');
    Route::get('/social-buzz-comments/{postId}/listing', 'Api\SocialBuzzController@getSocailBuzzComments');

   Route::get('/buyer/{id}/', 'Api\PublicProfileController@index');
   Route::get('/seller/{id}/', 'Api\PublicProfileController@sellerPublicProfile');
   
});


// auth:api | jwt.verify
Route::group(['middleware' => ['jwt', 'XSS'], 'prefix' => '/v1'], function () {
    Route::post('/logout', 'Api\UserController@logout');
    //Authenticated routes will be written here
    Route::post('/user/update-role', 'Api\UserController@updateRole');
    Route::post('/user/picture', 'Api\UserController@updateProfilePicture');
    Route::get('/user/info', 'Api\UserController@fetchUserInfo');
    Route::get('/user/manage-public-profile', 'Api\UserController@managePublicProfile');

    Route::post('/user/store-public-profile-image', 'Api\UserController@publicProfileStoreImage');
    Route::post('/user/store-public-profile', 'Api\UserController@publicProfileStore');
    Route::post('/user/store-public-profile-bio', 'Api\UserController@publicProfileStoreBio');
    Route::get('/buyer-account/details', 'Api\UserController@buyerAccount');
    Route::post('/user/edit-cover-pic', 'Api\UserController@editCoverPic');
    Route::post('/user-account-update', 'Api\UserController@userAccountUpdate');

    Route::get('/riders', 'Api\UserController@getRiders');
    Route::get('/followings', 'Api\UserController@getFollowing');
    Route::get('/awards', 'Api\UserController@getAwards');
    Route::get('/unfollow-user/{following}', 'Api\UserController@unfollowUser');
    Route::post('/follow-user', 'Api\SocialBuzzController@followUser');

    Route::post('/user/changePassword', 'Api\UserController@changePassword');
    Route::get('/categories', 'Api\TalentCategoryController@category');
    Route::get('/seller-account/details', 'Api\UserController@sellerAccount');
    Route::get('/seller-sales', 'Api\PublicProfileController@sellerSale');
    Route::post('/store-product-commercial', 'Api\PublicProfileController@storeProductCommercial');
    Route::post('/store-sample-product', 'Api\PublicProfileController@storeSampleProduct');
    Route::post('/store-upload-product', 'Api\PublicProfileController@storeUploadProduct');
    Route::post('/store-product', 'Api\PublicProfileController@storeProduct');
    Route::post('/update-product', 'Api\PublicProfileController@updateProduct');
    Route::any('/my-product/{days?}', 'Api\PublicProfileController@SellerProducts');
    Route::post('/bulk-delete-my-product', 'Api\PublicProfileController@bulkDeleteProducts');
    Route::post('/delete-my-product', 'Api\PublicProfileController@deleteMyProduct');

    Route::post('/create-social-buzz', 'Api\SocialBuzzController@postSocialBuzz');
    Route::post('/update-social-buzz', 'Api\SocialBuzzController@updateSocialBuzz');
    
    Route::post('/social-buzz-comment', 'Api\SocialBuzzController@postSocialBuzzComment');
    Route::post('/social-buzz-rider', 'Api\SocialBuzzController@postSocialBuzzRider');
    Route::post('/social-buzz-award', 'Api\SocialBuzzController@postSocialBuzzAward');
    Route::post('/social-buzz-report', 'Api\SocialBuzzController@socialBuzzReport');
    Route::get('/social-buzz-product-listing', 'Api\SocialBuzzController@socialBuzzProductListing');
    Route::post('/post-talent-award', 'Api\TalentCategoryController@postTalentAward');
    Route::get('/talent-award/{talentId}/listing', 'Api\TalentCategoryController@talentAwardListing');
    Route::get('/talent-rider/{talentId}/listing', 'Api\TalentCategoryController@talentRiderListing');
    Route::post('/talent/add-to-cart', 'Api\TalentCategoryController@addtoCart');
    Route::post('/post-talent-rider', 'Api\TalentCategoryController@postTalentRider');
    Route::post('/contact-message', 'Api\TalentCategoryController@contactMe');
    Route::post('/talent-report-seller', 'Api\TalentCategoryController@reportSeller');



    Route::get('/chat-message/{id}', 'Api\ChatMessageController@chat');
    Route::get('/chat-refresh/{id}/{lmi}', 'Api\ChatMessageController@refreshMessage');
    Route::post('/chat-message', 'Api\ChatMessageController@sendMessage');
    Route::get('/inbox-message', 'Api\ChatMessageController@getInboxMessage');
    Route::get('/getalluser', 'Api\ChatMessageController@getAllUser');
    Route::get('/getallreaduser', 'Api\ChatMessageController@getAllReadMsg');
    Route::get('/getallunreaduser', 'Api\ChatMessageController@getAllUnreadMsg');
    Route::post('/delete-message', 'Api\ChatMessageController@deleteInboxMessage');
    Route::post('/mass-delete-message', 'Api\ChatMessageController@massDeleteInboxMessage');
    Route::get('/auto-reply', 'Api\ChatMessageController@sendAutoMessage');
});