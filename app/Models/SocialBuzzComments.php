<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialBuzzComments extends Model
{
  protected $fillable = [
      'user_id','post_id','posted_by', 'posted_by','post_date','active','created_by', 'updated_by'
  ];

      public function commentBy() {
		    return $this->belongsTo('App\User', 'user_id', 'id');
	  }
  
}