<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialBuzzReports extends Model
{
  protected $fillable = [
      'user_id','post_id','award'
  ];  


  public function reportBy() {
	     return $this->belongsTo('App\User', 'user_id', 'id');
  }


}