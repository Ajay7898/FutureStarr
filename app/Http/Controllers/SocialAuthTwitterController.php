<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialTwitterAccountService;
use Auth;
use Log;
use Session;
class SocialAuthTwitterController extends Controller
{
  /**
   * Create a redirect method to twitter api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('twitter')->redirect();

    }

    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback(SocialTwitterAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
        auth()->login($user);
        Session::flash('success','Login successfully to futurestarr!');
        return redirect()->to('/home');
    }
}

