<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportChatGuest extends Model
{
    protected $fillable = [
      'created_by',
      'updated_by',
      'sender_id',
      'receiver_id',
      'message',
      'read',
      'message_media',
      'is_guest',
      'deleted_at'
    ];

    public function guestUser()
    {
      return $this->belongsTo('App\Models\GuestUser','sender_id','id');
    }
    public function adminUser()
    {
      return $this->belongsTo('App\User','sender_id','id');
    }

}
