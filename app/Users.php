<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','first_name','last_name','username','phone','address','email','profile_pic','password',
        'email_verified','vacation_mode','description','remember_token','experience_level', 'display_name', 'public_profile',
    ];

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

}
