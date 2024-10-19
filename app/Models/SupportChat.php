<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportChat extends Model
{
    protected $fillable = [];

    function getSender(){

        return $this->belongsTo('App\User', 'sender_id','id');
    }
    function getReceiver(){
        return $this->belongsTo('App\User', 'receiver_id','id');
    }

    public function User()
    {
        return $this->belongsTo('App\User','sender_id','id');
    }

    public function guestUser()
    {
      return $this->belongsTo('App\User','sender_id','id');
    }
    public function adminUser()
    {
      return $this->belongsTo('App\User','sender_id','id');
    }

}
