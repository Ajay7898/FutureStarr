<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerContacts extends Model
{
  protected $fillable = [
      'user_id','talent_id','msg_title','message', 'created_by', 'updated_by'
  ];
 
 
}
