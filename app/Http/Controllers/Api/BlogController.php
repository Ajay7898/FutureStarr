<?php 

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Repository\Apis\UserApi;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Http\Request;
use JWTAuth;
use Response;
use \Illuminate\Http\Response as Res;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Framework\Exception;
use URL;
use File;
use DB;
use App\Traits\MailsendTrait;

use App\Models\BlogContent;
use App\Models\BlogComment;
use App\Models\TalentCatagory;

class BlogController extends ApiController
{

     use MailsendTrait;

    /**
     * @var \App\Repository\Apis\UserApi
     * 
     */
    protected $userApi;

    public function __construct(userApi $userApi)
    {
        $this->userApi = $userApi;
    }

    /**
     * @description: Api talent categories listing
     * @param: 
     * @return: Json String response
     */

    public function blogs($id = '', Request $request)
    {
        try {
             $blogs = [];
             $latestBlog = [];
             $blogArray = [];
            
             
            $blogs = BlogContent::select("id", "title", "blog_img", "author_first_name", "author_last_name", "date", "blog_status","content")->where('blog_status', 1)->orderBy('id', 'DESC')
            ->limit(3)->get();

            foreach($blogs as $blog){
                $latestBlog[] = [
                    "id" => $blog->id,
                    "title" => $blog->title,
                    "blog_img" => $blog->blog_img,
                    "author_first_name" => $blog->author_first_name,
                    "author_last_name" => $blog->author_last_name,
                    "date" => date('M d, Y', strtotime($blog->date)),
                    "blog_status" => $blog->blog_status,
                    "content" => \Illuminate\Support\Str::limit(strip_tags($blog->content), 100)
                ];
            }
            
            $blogArray = ['latestBlog' => $latestBlog];
            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Blog listing!',
                    'file_url' => env('APP_FILE_URL'),
                    'data' => $blogArray
           ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function blogById($cat_slug = '', $blog_slug = '', Request $request) {
          
         $blogData = [];
         $blogCondition = ['slug' => $blog_slug];
         $blogData = BlogContent::with(['getBlogCatagories', 'getBlogComments'])->where($blogCondition)->first();

         return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Blog detailed data!',
                    'file_url' => env('APP_FILE_URL'),
                    'data' => $blogData
           ]);
    }

}
