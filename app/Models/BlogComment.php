<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
	
  protected $fillable = [
      'user_id','blog_id','message','created_by', 'updated_by',
  ];

  public function getCommentUser() {
	return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function  blogData() {
       return $this->belongsTo('App\Models\BlogContent', 'blog_id', 'id');
  }

}
