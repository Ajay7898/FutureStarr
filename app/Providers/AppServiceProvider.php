<?php

namespace App\Providers;
use App\Models\SupportChatGuest;
use App\User;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Admin\SupportChatGuestController;
use Session;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once(app_path('Helpers/Customhelper.php'));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

      view()->composer('*', function ($view)
      {
        $global_data = array();
        $support_user = User::find(env('SUPPORT_USER_ID'));
        if($support_user){
          $global_data['support_profile_image'] = $support_user->profile_pic;
        }else {
          $global_data['support_profile_image'] = NULL;
        }

        if(Session::has('chat_session_id') && Session::has('guest_user_id')){

          $guest_totalSorted = SupportChatGuestController::frontIndexGuest();

          $global_data['chat_session_id'] = Session::get('chat_session_id');
          $global_data['guest_user_id'] = Session::get('guest_user_id');
          $global_data['guest_user_name'] = Session::get('guest_user_name');
        }else {
          $guest_totalSorted = array();
        }
        $global_data['totalSorted'] = $guest_totalSorted;

          $view->with('global_data', $global_data );
      });

    }
}
