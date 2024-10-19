<?php

/*
|--------------------------------------------------------------------------
| Web Routes Admin Dashboard
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/admin/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

       Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
       Route::get('/dashboard-social-share', 'Admin\AdminController@create')->name('dashboard-social-share');

      Route::get('/admin/change-password', 'Admin\AdminController@change_password')->name('admin.change-password');
      Route::post('/admin/update-password', 'Admin\AdminController@update_password')->name('admin.update-password');

});

Route::group(['prefix' => 'admin/blog', 'middleware' => ['auth', 'admin']], function () {

     Route::get('/', 'Admin\BlogController@index')->name('admin.blog');
     Route::get('/create', 'Admin\BlogController@create')->name('admin.blog.create');
     Route::post('/store', 'Admin\BlogController@store')->name('admin.blog.store');
     Route::get('/edit/{id}', 'Admin\BlogController@edit')->name('admin.blog.edit');
     Route::post('/update/{id}', 'Admin\BlogController@update')->name('admin.blog.update');
     Route::post('/delete-blog/{id}', 'Admin\BlogController@destroy')->name('admin.blog.delete');
     Route::post('/blog-bulk-delete', 'Admin\BlogController@bulk_delete')->name('blog.bulk.delete');

     Route::get('/tags', 'Admin\BlogController@tags')->name('admin.tags');
     Route::get('/create-tag', 'Admin\BlogController@create_tag')->name('admin.create-tag');
     Route::post('/store-tag', 'Admin\BlogController@store_tag')->name('admin.blog.store-tag');
     Route::post('/search-tag', 'Admin\BlogController@tag_listing')->name('admin.search-tag');

     Route::get('/comments', 'Admin\BlogCommentController@index')->name('admin.blog.comment');
     Route::post('/comment-status/{blogId}', 'Admin\BlogCommentController@update')->name('admin.blog.comment.status');



});

Route::group(['prefix' => 'admin/users', 'middleware' => ['auth', 'admin']], function () {

     Route::get('/', 'Admin\UserController@index')->name('admin.users');
     Route::get('/monthly-signup', 'Admin\UserController@create')->name('admin.monthly-signup');

});

Route::group(['prefix' => 'admin/page', 'middleware' => ['auth', 'admin']], function () {

     Route::get('/talent-approve-disapprove', 'Admin\PageController@index')->name('admin.pages');
     Route::post('/talent-approve-disapprove', 'Admin\PageController@store')->name('admin.talent.store');
     Route::post('/delete-product/{id}', 'Admin\PageController@destroy')->name('admin.talent.delete');
     Route::post('/talent-bulk-delete', 'Admin\PageController@bulk_delete')->name('talent.bulk.delete');

});

Route::group(['prefix' => 'admin/email', 'middleware' => ['auth', 'admin']], function () {

       Route::get('/monthly', 'Admin\EmailController@index')->name('admin.emails');
       Route::get('/compose', 'Admin\EmailController@create')->name('admin.compose-email');
       Route::post('/send-email', 'Admin\EmailController@store')->name('admin.send-email');
});

Route::group(['prefix' => 'admin/seo', 'middleware' => ['auth', 'admin']], function () {

       Route::get('/dashboard', 'Admin\SeoController@index')->name('admin.seo');
       Route::get('/setting', 'Admin\SeoController@create')->name('admin.seo.setting');
       Route::post('/store', 'Admin\SeoController@store')->name('admin.seo.store');
       Route::get('/edit/{id}', 'Admin\SeoController@edit')->name('admin.seo.edit');
       Route::post('/update/{id}', 'Admin\SeoController@update')->name('admin.seo.update');

});

Route::group(['prefix' => 'admin/chat_support', 'middleware' => ['auth', 'admin']], function () {
     Route::get('/', 'Admin\SupportChatController@index')->name('admin.chat.support');
     Route::get('api/get-unread/{receiver_id}/{sender_id}', 'Admin\SupportChatController@getUnreadMessages')->name('admin.chat.get.unread');
     Route::get('api/get-chat/{receiver_id}/{sender_id}', 'Admin\SupportChatController@getChatMessages')->name('admin.chat.get.messages');
     Route::post('api/send/message', 'Admin\SupportChatController@store')->name('admin.chat.message.store');
});

Route::group(['prefix' => 'admin/guest_chat_support', 'middleware' => ['auth', 'admin']], function () {
     Route::get('/', 'Admin\SupportChatGuestController@index')->name('admin.guest.chat.support');
     Route::get('api/get-unread/{receiver_id}/{sender_id}', 'Admin\SupportChatGuestController@getUnreadMessages')->name('admin.guest.chat.get.unread');
     Route::get('api/get-chat/{receiver_id}/{sender_id}', 'Admin\SupportChatGuestController@getChatMessages')->name('admin.guest.chat.get.messages');
     Route::post('api/send/message', 'Admin\SupportChatGuestController@store')->name('admin.guest.chat.message.store');
});

Route::group(['prefix' => 'admin/starr-search-category', 'middleware' => ['auth', 'admin']], function () {

     Route::get('/', 'Admin\StarSearchCategoriesController@index')->name('admin.starr-search.categories');

     Route::get('/{id}', 'Admin\StarSearchCategoriesController@edit')->name('admin.starr-search.edit');
     Route::post('/{id}', 'Admin\StarSearchCategoriesController@update')->name('admin.starr-search.update');
    

});

Route::group(['prefix' => 'admin/site-config', 'middleware' => ['auth', 'admin']], function () {

     Route::get('/', 'Admin\SiteConfigController@index')->name('admin.site.config');
     Route::post('/store', 'Admin\SiteConfigController@store')->name('admin.site.config.store');
});


Route::group(['prefix' => 'admin/product', 'middleware' => ['auth', 'admin']], function () {

     Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
     Route::get('/create', 'Admin\ProductController@create')->name('admin.product.create');
     Route::post('/', 'Admin\ProductController@store')->name('admin.product.store');
     Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('admin.product.edit');
     Route::post('product-update', 'Admin\ProductController@update')->name('admin.product.update');
     Route::get('product-delete/{id}', 'Admin\ProductController@destroy')->name('admin.product.delete');
     Route::get('/media-upload', 'Admin\ProductController@mediaUpload')->name('admin.product.media');
     Route::post('/media-upload', 'Admin\ProductController@mediaUploadStore')->name('admin.product.mediastore');
     Route::post('publish', 'Admin\ProductController@publish')->name('admin.product.publish');
     // Route::get('/edit', 'Admin\ProductController@create')->name('admin.site.config.store');
     // Route::post('/update', 'Admin\ProductController@store')->name('admin.site.config.store');
});