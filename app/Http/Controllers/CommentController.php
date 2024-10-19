<?php

namespace App\Http\Controllers;
use App\Models\BlogComment;
use App\Models\BlogContent;
use Auth;
use Session;

use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function index(Request $request) {
		if (Auth::check() == true) {
			$request->validate([
				'message' => ['required'],    
			]);

			$blogComment = new BlogComment();
			$blogComment->user_id = Auth::user()->id;
			$blogComment->blog_id = $request['blog_id'];
			$blogComment->message = $request['message'];
			$blogComment->created_by = Auth::user()->id;
			$blogComment->updated_by = Auth::user()->id;
			$blogComment->save();
			$insertedId = $blogComment->id;

			$findBlog = Blogcontent::find($request['blog_id']);
            
			if(!empty($insertedId)){
				Session::flash('success', 'Your comment will visible once approved by admin. Thank you!.');
				return redirect('/blog/detailed/'.$findBlog['slug']);
			} else {
				Session::flash('error', 'Something went wrong.');
				return redirect('/blog/detailed/'.$findBlog['slug']);
			}
		} else {
			Session::flash('warning', 'Please login to make the comment.');
			return redirect('/blog/detailed/'.$findBlog['slug']);
		}
	}
}


