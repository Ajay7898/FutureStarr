<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccounts extends Model
{
    protected $fillable = ['user_id', 'facebook_link', 'twitter_link', 'insta_link'];
}
