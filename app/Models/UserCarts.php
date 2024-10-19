<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCarts extends Model
{
   protected $fillable = ['user_id', 'status_id', 'title','total_amount','quantity','active','created_by','updated_by'];   

}
