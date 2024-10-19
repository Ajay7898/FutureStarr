<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeletedAccount extends Model
{
  protected $fillable = [
      'user_id', 'description', 'account_type', 'email', 'created_at'
  ];
 
}
