<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
   protected $fillable = ['chat_id', 'sent_by', 'message', 'message_media', 'read_flag', 'created_at'];   

    
}
