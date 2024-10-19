<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentAwards extends Model
{
   protected $fillable = ['talent_id', 'user_id', 'awards'];   

   public function getUsers(){
          return $this->belongsTo('App\User', 'user_id','id');
   }
   public function getTalents(){
          return $this->belongsTo('App\Models\Talents', 'talent_id', 'id');
   }

   public function awardBy() {
   	   return $this->belongsTo('App\User', 'user_id','id');
   }
}
