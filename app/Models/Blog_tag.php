<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog_tag extends Model
{
    protected $fillable = ['blog_id', 'tag_id'];
}
