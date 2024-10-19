<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metatags extends Model
{
    protected $fillable = [
        'page_title','title','type','description','keywords'
    ];
}
