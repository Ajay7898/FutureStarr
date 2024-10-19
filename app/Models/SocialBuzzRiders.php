<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialBuzzRiders extends Model
{
  protected $fillable = [
      'user_id','post_id', 'social_buzz_by', 'rider', 'platform'
  ];

   
  public function rideBy() {
	     return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function following() {
  	return $this->belongsTo('App\User', 'social_buzz_by', 'id');
  }

  public function followers() {
  	return $this->belongsTo('App\User', 'user_id', 'id');
  }

}