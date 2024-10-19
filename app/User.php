<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Cache;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','first_name','last_name','username','phone','address','email','profile_pic','password',
        'email_verified','vacation_mode','description','remember_token','experience_level', 'display_name', 'public_profile','stripe_customer_id','card_last_four_digit'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOnline() {

        return Cache::has('user-is-online-' . $this->user_d);
    }


    public function getUserRole() {
            return $this->belongsTo('App\Models\UsersRoles', 'role_id', 'id');
    }
    public function getMessages() {
            return $this->hasMany('App\Models\SellerInboxes', 'user_id', 'id');
    }
    public function getSocialAccounts() {
            return $this->belongsTo('App\Models\SocialAccounts', 'id', 'user_id');
    } 
    public function checkScoialLogin() {
       return $this->belongsTo('App\SocialFacebookAccount','id','user_id');
    }

    public function messages()
    {
      return $this->hasMany(ChatMessage::class);
    }

    public function following() {
        return $this->hasMany('App\Models\Fanbase' , 'following', 'id')->where('following','=', Auth::user()->id);
    }

    public function followers() {
        return $this->hasMany('App\Models\Fanbase' , 'follower', 'id')->where('follower','=', Auth::user()->id);
    }


     /**
    * Check user email.
    *
    * @access protected
    * @param  $email [string]
    * @return Object
    */
    protected function checkUserEmail($email)
    {
        $result = User::select('id')
                    ->where('email', $email)
                    ->first();
        return $result;
    }

    /**
      * Check user email for facebook login.
      *
      * @access protected
      * @param  $email [string]
      * @return Object
      */
      protected function checkUserEmailForSocialLogin($email)
      {
            $result = User::select('id')
                        ->where('email', $email)
                        ->where(function($q) {
                            $q->where('provider', 'facebook')
                              ->orWhere('provider', 'linkedin');
                        })
                        ->first();
            return $result;
      }

    /**
    * Create social profile.
    *
    * @access protected
    * @param  $socialUser [array]
    * @return object
    */
    protected function createSocialAccount($socialUser)
    {
        $email = $socialUser['email'];
        $password = $socialUser['password'];
        $user = User::select('id')
                    ->where('email',$email)
                    ->first();
        if($user){
              $result = User::where(['email' => $email])->update(array('password' => $password));
        }else{
              $result = User::create($socialUser);
        }
        return $result;
    }

}
