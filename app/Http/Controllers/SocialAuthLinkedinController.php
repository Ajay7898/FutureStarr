<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialLinkedinAccountService;
use Auth;
use Session;
class SocialAuthLinkedinController extends Controller
{
  /**
   * Create a redirect method to linkedin api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Return a callback method from linkedin api.
     *
     * @return callback URL from linkedin
     */
    public function callback(SocialLinkedinAccountService $service)
    {
        $user = $service->createOrGetUser( Socialite::driver('linkedin')->user() );
        Auth::login($user,true);
        Session::flash('success','Login successfully to futurestarr!');
        return redirect()->to('/home');
    }
}

