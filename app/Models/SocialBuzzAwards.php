<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialBuzzAwards extends Model
{
  protected $fillable = [
      'user_id','post_id','award'
  ];  


  public function awardBy() {
	     return $this->belongsTo('App\User', 'user_id', 'id');
  }


}