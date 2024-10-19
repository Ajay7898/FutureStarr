<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentComments extends Model
{
    protected $fillable = ['talent_id','buyer_id','comment','created_by','updated_by'];


    public function commentBy() {
   	   return $this->belongsTo('App\User', 'buyer_id', 'id');
    }
    
}
