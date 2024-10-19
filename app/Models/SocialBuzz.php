<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB as DB;

class SocialBuzz extends Model
{
    protected $fillable = [
        'user_id','category_id','comment', 'posted_by', 'product_link','product_img_path','report','active','created_by', 'updated_by'
    ];

    public function getUserData() {
  	        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getTalentCatagories() {
  		      return $this->belongsTo(TalentCatagory::class, 'category_id');
  	}
    public function getSocialBuzzComments() {
            return $this->hasMany('App\Models\SocialBuzzComments','post_id', 'id')->with('commentBy');
    }
    public function getSocialBuzzRiders() {
            return $this->hasMany('App\Models\SocialBuzzRiders','post_id', 'id')->with('rideBy');

    }
    public function getSocialBuzzAwards() {
           return $this->hasMany('App\Models\SocialBuzzAwards','post_id', 'id')->with('awardBy')->where('award','=', 1);
    } 
    public function alreadyAwarded() {
         if(Auth::check()==true) {
           return $this->hasMany('App\Models\SocialBuzzAwards','post_id', 'id')->where('user_id','=', Auth::user()->id);
         } else {
           return $this->hasMany('App\Models\SocialBuzzAwards','post_id', 'id')->where('user_id','=', '');
         }
    } 
    public function selfRider() {
         if(Auth::check()==true) {
           return $this->hasMany('App\Models\SocialBuzzRiders','post_id', 'id')->where('user_id','=', Auth::user()->id);
         } else {
             return $this->hasMany('App\Models\SocialBuzzRiders','post_id', 'id')->where('user_id','=', '');
         }
    }
}

