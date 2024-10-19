<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerContacts extends Model
{
    protected $fillable = ['user_id', 'username', 'email', 'description'];
}
