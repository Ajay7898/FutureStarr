<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileVisitor extends Model
{
    protected $fillable = ['visitor_ip', 'visitor_country', 'profile', 'profile_id'];
}
