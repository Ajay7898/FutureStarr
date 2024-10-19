<?php 

namespace App\Http\Controllers\Api;

use App\Http\Requests;
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
use Auth;
use Carbon\Carbon;
use App\Models\SellerStripeAccounts;
use App\Traits\MailsendTrait;
use App\Models\TalentAwards;
use App\Models\BuyerProducts;
use App\Models\PurchasedProduct;
use App\Models\SampleMedia;
use App\Models\ProductMedia;
use App\Models\CommercialMedia;

use App\Models\TalentCatagory;
use App\Models\SocialBuzz;
use App\Models\SocialBuzzComments;
use App\Models\SocialBuzzReplies;
use App\Models\SocialBuzzRiders;
use App\Models\SocialBuzzAwards;
use App\Models\SocialBuzzReports;
use App\Models\CommercialAds;
use App\Models\Fanbase;
use App\Models\Talents;
use App\Models\PublicProfileMessage;
use App\Models\ProfileVisitor;
use App\User;
use DB;

class PublicProfileController extends ApiController
{

    use MailsendTrait;
 
    public function index($id = '')  {

        try {
          
            $user = [];
            $riders = [];
            $following = [];
            $self_rider = [];

           $user  = User::where('public_profile', $id)->first();

           if(empty($user) || $user['role_id'] != '3') {

              return $this->respond([
                  'status' => 'Failure',
                  'status_code' => $this->getStatusCode(),
                  'message' => 'No profile exist!',
              ]);

           } else {
      
             $riders = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile',  'users_roles.name as role')
                ->where('following', $user['id'])
                ->get();

    
             $following = Fanbase::where('follower', $user['id'])->count();
             $profile_views = ProfileVisitor::where(['profile_id' => $user['id'] ])->count();

             $metaTags = [];
             $metaTags  = ['title' => $user['username'], 'description' => $user['description'], 'keywords' => $user['username']];

  
             $whereCondition = ['user_id' => $user['id'], 'active' => 1];
             $socialBuzzList = SocialBuzz::withCount(['getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards'])->with('getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards')->where($whereCondition)->orderBy('id', 'DESC')->get();

             $responseArray = array(
                      'user' => $user, 
                      'following' => $following, 
                      'riders' => $riders, 
                      'self_rider' => $self_rider, 
                      'profile_views' => $profile_views, 
                      'socialBuzzList' => $socialBuzzList, 
                      'metaTags'  => $metaTags
             );

              return $this->respond([
                  'status' => 'success',
                  'status_code' => $this->getStatusCode(),
                  'message' => 'Public profile data!',
                  'data' => $responseArray 
              ]);

           }
         } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
         }
    }

    public function sellerPublicProfile($id = '') {

        try {

             $user    = [];
             $riders  = [];
             $following = [];
             $talents   = [];
             $socialBuzzList = [];

             $user  = User::where('public_profile', $id)->first();
             if(empty($user)) {
                  
                  return $this->respond([
                      'status' => 'Failure',
                      'status_code' => $this->getStatusCode(),
                      'message' => 'No profile exist!',
                  ]);
             }

             $riders = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('following', $user['id'])
                ->count();

             $following = Fanbase::where('follower', $user['id'])->count();
             $profile_views = ProfileVisitor::where(['profile_id' => $user['id'] ])->count();

              $metaTags = [];
              $metaTags  = ['title' => $user['username'], 'description' => $user['description'], 'keywords' => $user['username']];

             $whereCondition = ['user_id' => $user['id'], 'active' => 1];
             $socialBuzzList = SocialBuzz::withCount(['getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards'])->where($whereCondition)->orderBy('id', 'DESC')->take(10)->get();
             $i = 0;
            foreach($socialBuzzList as $socialBuzz){
                $url = $socialBuzz->product_link;
                $host = explode('/',$url); 
                $talentId = !empty($host[5])?$host[5]:'';
                $socialBuzzList[$i]->get_social_buzz_purchased_count = PurchasedProduct::join('talents','talents.id', '=', 'purchased_products.talent_id')->where('talents.slug','=', $talentId)->count();
                $i++;
            }
             
            $extra    = [];
            if($user['role_id'] == '4'){
                $talent_where = ['user_id' => $user['id'], 'approved' => 1];
                $talents = Talents::with(['commercialMedia'])->where($talent_where)->take(10)->get();
                if (!empty($user['id'])) {
                    $talentCondition = ['user_id' => $user['id'], 'active' => 'Active'];
                    $talentOne = Talents::where($talentCondition)->get();
                    $talentIdsArray = [];
                    $talendAwardUsers = [];
                    foreach ($talentOne as $key => $value) {
                        array_push($talentIdsArray, $value->id);
                    }
                    $talendAwardUsers = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->get()->count();
                    
                } else {
                    $talendAwardUsers = 0;
                }
    
                if(!empty($user['id'])) {
                    $condition = ['user_id' => $user['id']];
                    $sellerTalent = BuyerProducts::where($condition)->count();
                    $sales = $sellerTalent;
                }else{
                    $sales = 0;
                }
                $extra    = [
                    'talents' => $talents,
                    'awards' => $talendAwardUsers,
                    'sales' => $sales
                ]; 
                          
            }elseif($user['role_id'] == '3'){
                $buyerTotalPurchase = PurchasedProduct::where('user_id', '=', $user['id'])->sum('total_amount');

                $extra    = [
                    'buyerTotalPurchase' => $buyerTotalPurchase
                ];      
            }

             $responseArray = array(

                      'user' => $user, 
                      'following' => $following, 
                      'riders' => $riders, 
                      'profile_views' => $profile_views, 
                      'socialBuzzList' => $socialBuzzList, 
                      'metaTags'  => $metaTags
             );

             $responseArray = array_merge($responseArray, $extra);

              return $this->respond([
                  'status' => 'success',
                  'status_code' => $this->getStatusCode(),
                  'message' => 'Public profile data!',
                  'file_url' => env('APP_FILE_URL'),
                  'data' => $responseArray 
              ]);

         } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
         }

    }

    public function getTrendingsList(Request $request, $id) 
    {
        try {
            $socialBuzzList   = [];
            $per_page = isset($request->per_page) ? $request->per_page : 10;
            $user  = User::where('public_profile', $id)->first();
            $whereCondition = ['user_id' => $user['id'], 'active' => 1];
            $socialBuzzList = SocialBuzz::withCount(['getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards'])->where($whereCondition)->orderBy('id', 'DESC')->paginate($per_page);
            $i = 0;
            foreach($socialBuzzList as $socialBuzz){
                $url = $socialBuzz->product_link;
                $host = explode('/',$url); 
                $talentId = !empty($host[5])?$host[5]:'';
                $socialBuzzList[$i]->get_social_buzz_purchased_count = PurchasedProduct::join('talents','talents.id', '=', 'purchased_products.talent_id')->where('talents.slug','=', $talentId)->count();
                $i++;
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Trending List data!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $socialBuzzList 
            ]);
         } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
         }
    }

    public function getSimilarProductList(Request $request, $id) 
    {
        try {
            $talents   = [];
            $per_page = isset($request->per_page) ? $request->per_page : 10;
            $user  = User::where('public_profile', $id)->first();
            $talent_where = ['user_id' => $user['id'], 'approved' => 1];
            $talents = Talents::with(['commercialMedia'])->where($talent_where)->paginate($per_page);
           
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Similar Product List data!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $talents 
            ]);
         } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
         }

    }

    /**
     * @description: Api For Edit Sample Product
     * @param: 
     * @return: Json String Response
     */
    public function storeSampleProduct(Request $request) 
    {
        try {
            $rules = array(
                'sampleproduct' => 'required|mimes:jpeg,bmp,png,jpg,mp4,application/octet-stream,audio/mpeg,mpga,mp3,wav'
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $video_path = '';
            if($request->has('sampleproduct') ) {
                $video = $request->file('sampleproduct');
            
                $extension = $video->extension();
                $vidfilename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $video_name = md5($vidfilename). '.' .$extension;

                $fpath = env('APP_FILE_UPLOAD');
                $destinationPath = $fpath.'/public/uploads/seller-video/';
                $uploaded = $video->move($destinationPath,$video_name);
                $file_name = $uploaded->getFileName();
                // if($userData['bio_video'] != '' ){
                //     unlink($userData['bio_video']);
                // } 

                $video_path = 'uploads/seller-video/' . $file_name;
            }
            if(!empty($video_path)){
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Sample Product updated successfully!',
                    'file_url' => env('APP_FILE_URL'),
                    'data' =>  [
                        'sampleproduct' => $video_path
                    ]
                ]);
            } else {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to upload the requested files. Please try agian later.'
                ]);
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Api For Edit Manage Profile Image
     * @param: 
     * @return: Json String Response
     */
    public function storeProductCommercial(Request $request) 
    {
        try {
            $rules = array(
                'commercial' => 'required|mimes:jpeg,bmp,png,jpg,mp4,wav,application/octet-stream,audio/mpeg,mpga,mp3'
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            if(!empty(Auth::check())) {
                $path_name = '';
                $image_data = $request['commercial'];
                if(!empty($image_data)) {
                    $file = $request->file('commercial');
                    $fileType = $file->getMimeType();
                    $fileExt = $file->getClientOriginalExtension();
                    $imgfilename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                    $fileName = md5($imgfilename).'.'.$fileExt;

                    $fpath = env('APP_FILE_UPLOAD');
                    $destinationPath = $fpath.'/public/uploads/commercial-product/';
                    $uploaded = $file->move($destinationPath,$fileName);
                    $file_name = $uploaded->getFileName();
                    
                    $path_name = 'uploads/commercial-product/' . $file_name;
                        
                }
                if(!empty($path_name)){
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Product Commercial updated successfully!',
                        'file_url' => env('APP_FILE_URL'),
                        'data' =>  [
                            'commercialproduct' => $path_name
                        ]
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to upload the requested files. Please try agian later.'
                    ]);
                }
            } else {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to upload the requested files. Please try agian later.'
                ]);
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Api For Edit Manage Profile Image
     * @param: 
     * @return: Json String Response
     */
    public function storeUploadProduct(Request $request) 
    {
        try {
            $rules = array(
                'uploadproduct' => 'required|mimes:jpeg,bmp,png,jpg,mp4,pdf,application/octet-stream,audio/mpeg,mpga,mp3,wav'
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            if(!empty(Auth::check())) {
                $path_name = '';
                $image_data = $request['uploadproduct'];
                if(!empty($image_data)) {
                    $file = $request->file('uploadproduct');
                    $fileType = $file->getMimeType();
                    $fileExt = $file->getClientOriginalExtension();
                    $imgfilename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                    $fileName = md5($imgfilename).'.'.$fileExt;

                    $fpath = env('APP_FILE_UPLOAD');
                    $destinationPath = $fpath.'/public/uploads/seller-product-media/';
                    $uploaded = $file->move($destinationPath,$fileName);
                    $file_name = $uploaded->getFileName();
                    
                    $path_name = 'uploads/seller-product-media/' . $file_name;
                        
                }
                if(!empty($path_name)){
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Product uploaded successfully!',
                        'file_url' => env('APP_FILE_URL'),
                        'data' =>  [
                            'uploadproduct' => $path_name
                        ]
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to upload the requested files. Please try agian later.'
                    ]);
                }
            } else {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to upload the requested files. Please try agian later.'
                ]);
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Api To store product
     * @param: NULL
     * @return: Json String Response
     */
    public function storeProduct(Request $request) 
    {
        try {
            if(!empty(Auth::check())){
              $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=', Auth::id())->first();
              if($checkSellerStripeAccount == null){
                 return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Futurestarr found that you have not connected your stripe account with Future Starr Stripe.'
                    ]);
              }
                if (!empty($request->all())) {
                    $rules = array(
                        'category' => 'required',
                        'title' => 'required|unique:talents,title',
                        'description' => 'required',
                        'price' => 'required',
                        'product_info' => 'required',
                        'facebookLink' => 'required',
                        'instagramLink' => 'required',
                        'twitterLink' => 'required',
                        'sampleproduct' => 'required',
                        'uploadproduct' => 'required',
                        'commercial' => 'required'
                    );
                    $validator = Validator::make($request->all(), $rules);
        
                    if ($validator->fails()) {
                        return $this->respondValidationError('Fields Validation Failed.', $validator);
                    } else {
                        $poductArray = [
                            'user_id'=>Auth::user()->id,
                            'talent_category_id' => $request['category'],
                            'title' => $request['title'],
                            'slug'  => \Str::slug($request['title']),
                            'description' => $request['description'],
                            'price' => $request['price'],
                            'product_info' => $request['product_info'],
                            'facebookLink' => $request['facebookLink'],
                            'instagramLink' => $request['instagramLink'],
                            'twitterLink' => $request['twitterLink'],
                            'created_by' => Auth::user()->id,
                            'updated_by' => Auth::user()->id,
                            'date' => Carbon::now()->format('Y-m-d')
                        ];
                        $talentInsert = Talents::insertGetId($poductArray);
                        if (!empty($talentInsert)) {
                            
                            $sampleMediaPath = '';
                            $productMedia    = '';
                            $commercialMedia = '';

                            $video_path_info = pathinfo($request['sampleproduct']);
                            $sampleMediaArray = ['talent_id' => $talentInsert, 'path_name' => $request['sampleproduct'], 'video_name' => $video_path_info['basename']];
                            $sampleMediaPath = $request['sampleproduct'];
                            SampleMedia::insert($sampleMediaArray);

                            $pdf_path_info = pathinfo($request['uploadproduct']);
                            $productMediaArray = ['talent_id' => $talentInsert, 'pdf_name' => $pdf_path_info['basename'], 'pdf_path' => $request['uploadproduct']];
                            $productMedia = $request['uploadproduct'];
                            ProductMedia::create($productMediaArray);

                            $image_path_info = pathinfo($request['commercial']);
                            $commercialMediaArray = ['talent_id' => $talentInsert, 'image_name' => $image_path_info['basename'], 'image_path' => $request['commercial']];
                            $commercialMedia = $request['commercial'];
                            CommercialMedia::insert($commercialMediaArray);
                            
                            $user = User::find(Auth::user()->id);
                            if (!empty($user)) {
                                $categoryName = TalentCatagory::pluck('name')->first();
                                $commercialMedia = $sampleMediaPath;
                                $sampleMedia = $productMedia;
                                $uploadedProduct = $commercialMedia;
                                $data = array('talent_id' => $talentInsert, 'title' => $request['title'], 'description' => $request['product_info'], 'category' => $categoryName, 'price' => $request['price'], 'seller_name' => $user->first_name . " " . $user->last_name, 'pathToImage' => '', 'commercialMedia'=> $commercialMedia, 'sampleMedia' => $sampleMedia, 'productMedia' => $uploadedProduct , 'slug' => \Str::slug($request['title']));
                            /* Mail goes to admin to approve the talent ***/
                                $this->talentApprovalMail($data);
                            }
                            $poductArray = array_merge(['talent_id' => $talentInsert], $poductArray);
                            return $this->respond([
                                'status' => 'success',
                                'status_code' => $this->getStatusCode(),
                                'message' => 'Product added successfully and sent for the admin approval.',
                                'file_url' => env('APP_FILE_URL'),
                                'data' => $poductArray
                            ]);
                        } else {
                            return $this->respond([
                                'status' => 'error',
                                'status_code' => $this->getStatusCode(),
                                'message' => 'Error while adding the product.'
                            ]);
                        }
                    }
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Error while adding the product.'
                    ]);
                }
            } else {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'You must be login firstly.'
                ]);
            }
        }catch(Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Api To update product
     * @param: NULL
     * @return: Json String Response
     */
    public function updateProduct(Request $request) 
    {
        try {
            if(!empty(Auth::check())){
                if (!empty($request->all())) {
                    $rules = array(
                        'talent_id' => 'required',
                        'category' => 'required',
                        'title' => 'required|unique:talents,title,'.$request['talent_id'],
                        'description' => 'required',
                        'price' => 'required',
                        'product_info' => 'required'
                    );
                    $validator = Validator::make($request->all(), $rules);
        
                    if ($validator->fails()) {
                        return $this->respondValidationError('Fields Validation Failed.', $validator);
                    } else {
                        $productArray = [
                            'user_id'=>Auth::user()->id,
                            'talent_category_id' => $request['category'],
                            'title' => $request['title'],
                            'slug'  => \Str::slug($request['title']),
                            'description' => $request['description'],
                            'price' => $request['price'],
                            'product_info' => $request['product_info'],
                            'created_by' => Auth::user()->id,
                            'updated_by' => Auth::user()->id,
                            'date' => Carbon::now()->format('Y-m-d')
                        ];
                        $talent_id = $request['talent_id'];
                        $whereCondition = ['active' =>'Active' ,'id' => $talent_id];
                        $updated = Talents::where($whereCondition)->update($productArray);
                        if (!empty($updated)) {

                            $updateCondtion  = ['talent_id' => $talent_id];
                            if($request['sampleproduct  '] != ''){
                                $video_path_info = pathinfo($request['sampleproduct']);
                                $sampleMediaArray = ['talent_id' => $talent_id, 'path_name' => $request['sampleproduct'], 'video_name' => $video_path_info['basename']];
                                SampleMedia::where($updateCondtion)->update($sampleMediaArray);
                            }
                            
                            if($request['uploadproduct'] != ''){
                                $pdf_path_info = pathinfo($request['uploadproduct']);
                                $productMediaArray = ['talent_id' => $talent_id, 'pdf_name' => $pdf_path_info['basename'], 'pdf_path' => $request['uploadproduct']];
                                ProductMedia::where($updateCondtion)->update($productMediaArray);
                            }

                            if($request['commercial'] != ''){
                                $image_path_info = pathinfo($request['commercial']);
                                $commercialMediaArray = ['talent_id' => $talent_id, 'image_name' => $image_path_info['basename'], 'image_path' => $request['commercial']];
                                CommercialMedia::where($updateCondtion)->update($commercialMediaArray);
                            }
                            
                            return $this->respond([
                                'status' => 'success',
                                'status_code' => $this->getStatusCode(),
                                'message' => 'Product updated successfully.',
                                'file_url' => env('APP_FILE_URL'),
                                'data' => $productArray
                            ]);
                        } else {
                            return $this->respond([
                                'status' => 'error',
                                'status_code' => $this->getStatusCode(),
                                'message' => 'Error while adding the product.'
                            ]);
                        }
                    }
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Error while adding the product.'
                    ]);
                }
            } else {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'You must be login firstly.'
                ]);
            }
        }catch(Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function SellerProducts(Request $request, $days = '') 
    {
        try {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $days = !empty($days) ? $days : 0;
                $newDay = ($days - 1);
                $per_page = isset($request->per_page) ? $request->per_page : 10;

                $today_date = Carbon::now()->format('Y-m-d');
                $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
                if (!empty($days) && $days > 0) {
                    $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                    $talents = Talents::with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards', 'user')->where($whereCondition)->where('talents.date', '<=', $today_date)->where('talents.date', '>=', $end_date)->orderBy('id', 'DESC')->paginate($per_page);
                } else {
                    $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                    $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->whereHas('getUserData', function ($query) {
                        $query->where('users.id', '!=', '');
                    })->paginate($per_page);
                }


                $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$id)->first();
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Product List!',
                    'file_url' => env('APP_FILE_URL'),
                    'data' => [
                      'talents' => $talents, 
                      'checkSellerStripeAccount'=> $checkSellerStripeAccount,
                      'award_count' => getSellerTalentAward(Auth::id())
                    ]
                ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function bulkDeleteProducts(Request $request) {
        try {
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentArray = ['active' => 'Deactive'];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Deleted successfully.'
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to deleted the products.'
                    ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function deleteMyProduct(Request $request) 
    {
        try {
            if (!empty($request->all())) {
                $talentArray = ['active' => 'Deactive'];
                $talentsDeleted = Talents::Where('id', $request['talent_id'])->update($talentArray);
                if (!empty($talentsDeleted)) {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Deleted successfully.'
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to deleted the products.'
                    ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


        /**
     * Function to purchase the commercial ads plan .
     * payment method :  PAYPAL
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function sellerSale(Request $request) {
      // try{
            $todayPurchasedIdArray = [];
            $purchasedIdArray = [];
            $getAllDetails = [];
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $today = Carbon::now()->format('Y-m-d');
            $condition = ['user_id' => $id, 'date' => $today];
            $sellerTalent = BuyerProducts::where($condition)->get();
            if (!empty($sellerTalent)) {
                foreach ($sellerTalent as $key => $value) {
                    $talentId = $value->pp_id;
                    array_push($todayPurchasedIdArray, $talentId);
                }
            }
            $sellerTalentAll = BuyerProducts::where('user_id', $id)->get();
            if (!empty($sellerTalentAll)) {
                foreach ($sellerTalentAll as $key => $value) {
                    $talentId = $value->pp_id;
                    array_push($purchasedIdArray, $talentId);
                }
            }
            $whereCondition = ['delete_flag' => 0, 'purchased' => 1];

            $dailySales = PurchasedProduct::whereIn('id', $todayPurchasedIdArray)
                ->where($whereCondition)
                ->count();

            $dailyRevenue = PurchasedProduct::whereIn('id', $todayPurchasedIdArray)
                ->where($whereCondition)
                ->get()
                ->pluck('total_amount')
                ->sum();

            $totalRevenue =PurchasedProduct::whereIn('id', $purchasedIdArray)
                ->where($whereCondition)
                ->get()
                ->pluck('total_amount')
                ->sum();

            $downloads = BuyerProducts::where('user_id', $id)->count();
            $data = ['dailySales' => $dailySales, 'dailyRevenue' => $dailyRevenue, 'totalRevenue' => $totalRevenue, 'downloads' => $downloads];

            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Seles info',
                    'data'  =>  $data,
                ]);
        // }catch(Exception $e) {
        //     return $this->respondWithError($e->getMessage());
        // }
    }


}