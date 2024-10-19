<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
    protected $fillable = ['name', 'permission'];
}
