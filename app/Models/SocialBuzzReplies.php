<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialBuzzReplies extends Model
{
  protected $fillable = [
      'user_id','comment_id','reply', 'reply_date','active'
  ];
  
}