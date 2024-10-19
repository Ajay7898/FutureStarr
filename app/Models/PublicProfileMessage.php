<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicProfileMessage extends Model
{
    protected $fillable = ['message_to', 'message_from', 'message'];
}
