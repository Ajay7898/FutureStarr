<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentCatagory extends Model
{
     protected $fillable = ['name','catagory_image_path','catagory_desc','catagory_main_banner','catagory_banner','catagory_detailed_banner','catagory_detailed_icon_img','tarending_catagory_sidebar_icon'];
}
