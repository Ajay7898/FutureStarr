<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPlans extends Model
{
    protected $fillable = ['user_id', 'custom_plan', 'created_by','updated_by'];
}
