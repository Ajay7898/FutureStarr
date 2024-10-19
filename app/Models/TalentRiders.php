<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentRiders extends Model
{
   protected $fillable = ['talent_id', 'talent_by', 'user_id', 'rider'];   

   public function rideBy() {
   	   return $this->belongsTo('App\User', 'user_id','id');
    }

}
