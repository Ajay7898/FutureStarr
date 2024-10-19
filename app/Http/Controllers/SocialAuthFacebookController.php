<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Auth;
use Session;
class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {   
        Session::flash('url', url()->previous());
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {
         $user = $service->createOrGetUser( Socialite::driver('facebook')->user() );
         Auth::login($user,true);
         Session::flash('success','Login successfully to futurestarr!');
         return redirect()->to(Session::get('url'));
    }
}

