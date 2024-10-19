<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{


   protected $fillable = ['sent_by', 'received_by', 'last_activity', 'last_activity', 'last_message', 'message_media', 'deleted_sent_by', 'deleted_received_by'];   

    public function getSenderProfile() {
        return $this->belongsTo('App\User', 'sent_by','id');
    }

    public function getReciverProfile() {
        return $this->belongsTo('App\User', 'received_by','id');
    }

    public function getMessageCount(){
        return $this->hasMany('App\Models\ChatMessages', 'chat_id', 'id')->where('read_flag','=','0');
    }
    
    public function isFavroite(){
         return $this->belongsTo('App\Models\FavrioteUser', 'received_by','fav_user_id')->where('user_id','=',Auth::user()->id);
    }
}
