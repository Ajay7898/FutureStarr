<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialShares extends Model
{
    protected $fillable = ['name', 'link', 'total_count', 'created_by', 'updated_by'];

}
