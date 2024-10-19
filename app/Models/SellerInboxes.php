<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerInboxes extends Model
{
     protected $fillable = ['user_id', 'talent_id', 'name', 'message', 'time', 'posted_by', 'active'       
     ];
}
