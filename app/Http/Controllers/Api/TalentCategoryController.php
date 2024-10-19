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
use App\Traits\MailsendTrait;

use App\Models\TalentCatagory;
use App\Models\ContactUs;
use App\Models\Talents;
use App\Models\TalentAwards;
use App\Models\TalentRiders;
use App\Models\BuyerContacts;
use App\Models\BuyerProducts;
use App\Models\UserCarts;
use App\Models\SellerReport;
use App\Models\PurchasedProduct;
use Carbon\Carbon;
use App\User;

class TalentCategoryController extends ApiController
{

     use MailsendTrait;

    /**
     * @description: Api talent categories listing
     * @param: 
     * @return: Json String response
     */
    public function category(Request $request) 
    {
        try {
            $catagories = TalentCatagory::select('id','name')->get();
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Category listing!',
                'data' => $catagories
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Api talent categories listing
     * @param: 
     * @return: Json String response
     */

    public function futureStarrMarketplace(Request $request)
    {
        try {
            $catagories = [];
            $tCatagories = TalentCatagory::get()->random(8);
            foreach($tCatagories as $category){
                $catagories[] = [
                    "id" => $category->id,
                    "name" => $category->name,
                    "slug" => $category->slug,
                    "catagory_image_path" => "assets/".$category->catagory_image_path,
                    "catagory_desc" => \Illuminate\Support\Str::limit(strip_tags($category->catagory_desc), 200)
                ];
            }
            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Future starr marketplace listing!',
                    'file_url' => env('APP_FILE_URL'),
                    'data' => $catagories,
           ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: single category information 
     * @param: GET $id
     * @return: Json String response
     */   
    
    public function categoryById($id = '', Request $request)
    {
            $category = [];
            $category = TalentCatagory::where('id', $id)->first();

            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Category info!',
                    'file_url' => env('APP_FILE_URL'),
                    'data' => $category,
           ]);
    }
    
    /**
     * @description: Talent listing by category
     * @param: GET $slug
     * @return: Json String response
    */ 

    public function talentsByCategory($slug = '', Request $request) 
    {
    	try {
            
            $talents = array();
    		$talent_category_id  = TalentCatagory::where('slug','=',$slug)->first();
    		if(!empty($talent_category_id)) {
                
                $id = $talent_category_id['id'];
                $condition = ['talent_category_id' => $id ,'approved' => 1 ,'active' =>'Active'];
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where($condition)->get();
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Talent listing by category',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $talents,
            ]);

    	} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
   
     /**
     * @description: Single product information 
     * @param: GET $id (product slug)
     * @return: Json String response
     */ 

    public function productByCategory($id = '', Request $request)
    {
    	try {
            
            $talent = array();
    		$condition = ['slug' => $id ,'approved' => 1 ,'active' =>'Active'];
            $talent = Talents::withCount(['getTalentRiders', 'getTalentAwards', 'getDownloads', 'talentComments'])->with('commercialMedia','sampleMedia', 'productMedia', 'talentComments', 'getUserData', 'getTalentAwards', 'getTalentRiders','getDownloads','alreadyAwarded','selfRider')->where($condition)->first();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product information!',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $talent,
            ]);

    	} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

     /**
     * @description: post talent award 
     * @param: product id $id
     * @return: Json String response
     */ 

     public function postTalentAward(Request $request)  {
            try {
                $rules = array(

                    'talent_id' => 'required',
                    'user_id'   => 'required'
                );
              
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
                } else {

                    $checkCondition = ['user_id' => $request->user_id, 'talent_id' => $request->talent_id ];
                    $checkAlreadyExist = TalentAwards::where($checkCondition)->first();

                    if(!empty($checkAlreadyExist)) {
                       
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Already awarded this talent.',
                        ]);

                    } else {
                    
                        $award = 1;
                        $table_array = array(

                            'user_id' => $request->user_id,
                            'talent_id' => $request->talent_id,
                            'awards'   => $award            
                         );
                        
                        $awarded = TalentAwards::create($table_array);
                       
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Award Added Successfully.',
                        ]);
                    }
                    
                }
            } catch (Exception $e) {
                return $this->respondWithError($e->getMessage());
            }
     } 
     

     /**
     * @description: get talent award list
     * @param: award listing
     * @return: Json String response
     */ 

    public function talentAwardListing($id = '') {  
        
        try {
        
            $talentAwards = array();

            $talentAwards = TalentAwards::with(['awardBy'])->where('talent_id', $id)->get();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Talent Awards!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $talentAwards,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    

     /**
     * @description: post talent rider 
     * @param: product id $id
     * @return: Json String response
     */ 

    public function postTalentRider(Request $request) {
      
      try {
            $rules = array(

                'talent_id' => 'required',
                'user_id'   => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {

                $checkCondition = ['user_id' => $request->user_id, 'talent_id' => $request->talent_id ];
                $checkAlreadyExist = TalentRiders::where($checkCondition)->first();

                if(!empty($checkAlreadyExist)) {
                   
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'You are already a rider .',
                    ]);

                } else {
                
                    $talent_by = Talents::where('id', $request->talent_id)->pluck('user_id')->first();

                    $table_array = array(

                        'user_id' => $request->user_id,
                        'talent_id' => $request->talent_id,
                        'talent_by' => $talent_by,
                        'rider'   => '1'            
                     );
                    
                    $awarded = TalentRiders::create($table_array);
                   
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Rider Added Successfully.',
                    ]);
                }
                
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
     }
    
     
     /**
     * @description: get talent award list
     * @param: award listing
     * @return: Json String response
     */ 

    public function talentRiderListing($id = '') {  
        
        try {
        
            $talentRiders = array();

            $talentRiders = TalentRiders::with(['rideBy'])->where('talent_id', $id)->get();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Talent Riders!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $talentRiders,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Contact Me from product info page api 
     * @param: POST
     * @return: Json String response
     */ 

    public function contactMe(Request $request)
    {

       try {
            $rules = array(
                'title'       => 'required',
                'message'     => 'required',   
                'talent_id'   => 'required',
                'user_id'     => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {
                
                $insertedArr = array(
                        'msg_title'    => $request->title,
                        'message'      => $request->message,
                        'user_id'      => $request->user_id,
                        'talent_id'    => $request->talent_id,
                        'created_by'   => $request->user_id,
                        'updated_by'   => $request->user_id,
                    );
                $contact = BuyerContacts::create($insertedArr);
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Message sent successfully!',
                ]);
                
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Contact us page 
     * @param: POST
     * @return: Json String response
     */   
    
    public function contactus(Request $request)
    {

       try {
            $rules = array(
                'name'        => ['required','string', 'max:50'],
                'phone'       => ['required','numeric'],
                'email'       => ['required'],
                'message'     => ['required'],    
                'g-recaptcha-response' => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {
                
                $insertedArr = array(
                        'name'    => $request['name'],
                        'phone'   => $request['phone'],
                        'email'   => $request['email'],
                        'message' => $request['message']
                    );

                $contact = ContactUs::create($insertedArr);

                $this->sendConfirmationMail($request['email'], $request['name']);
                $this->sendContactRequestMailToAdmin('custserv@futureStarr.com', 'Futurestarr', $request);

                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Message sent successfully!',
                ]);
                
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
     
     /**
     * @description: Report Seller 
     * @param: POST
     * @return: Json String response
     */

    public function reportSeller(Request $request){
            
		try {

            $rules = array(
                
                'talent_id' => 'required',
                'user_id'   => 'required',
                'comment'   => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {

                    $isAlreadyReported = [];
                    $checkCondition = ['talent_id' => $request->talent_id, 'user_id' => $request->user_id];
                    $isAlreadyReported = SellerReport::where($checkCondition)->first();

                    if(!empty($isAlreadyReported)) {
                    
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'You have already reported this seller.',
                        ]);

                    } else {

                        $table_array = array (
                           'talent_id' => $request->talent_id,
                           'user_id'   => $request->user_id,
                           'comment'   => $request->comment
                        );

                        $saved = SellerReport::create($table_array);

                        /*** REPORTER DATA START*******/

                          $reporter = User::find($request->user_id);
                          $report_name = $reporter['first_name'] . ' ' . $reporter['last_name'];
                          $report_email = $reporter['email'];

                         /*** REPORTER DATA END*******/

                         /*** REPORT DATA START ******/
                          
                          $reportData = Talents::with(['getUserData'])->where('id', $request->talent_id)->first();
                          $email = $reportData->getUserData['email'];
                          $name = $reportData->getUserData['first_name'] . ' ' . $reportData->getUserData['last_name'];
                          $comment = $reportData['comment'];
                          $created_at = $reportData->getUserData['created_at'];

                         /*** REPORT DATA END ******/


                         $mail = $this->sendSellerReportMailToAdmin($email, $name, $comment, $report_name, $report_email);
                       
                        /** EMAIL FUNCTION END **/

                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Seller Reported Successfully!.',
                        ]);
                    }

             }          
            
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addtoCart(Request $request) {

        try {

            $rules = array(
                
                'talent_id' => 'required',
                'user_id'        => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {
                   
                $talent = Talents::where('id','=', $request->talent_id )->first();
                 
                $title = $talent['title'];
                $amount = $talent['price'];

                $condition = ['buyer_id' => $request->user_id, 'talent_id'=> $request->talent_id, 'active'=> 1];
                $checkAlreadyPurhased = BuyerProducts::where($condition)->count();

                if(!empty($checkAlreadyPurhased)) {
                    
                    return $this->respond([
                        'status' => 'Info',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'You have already purchased this product.',
                    ]);

                } else {

                    $cartCondition = ['status_id' => 1, 'user_id' => $request->user_id, 'active' => 0];
                    $checkCart = UserCarts::where($cartCondition)->where('status_id','<>','3')->get();

                    if(count($checkCart)==0) {
                        
                        $userCartArray = ['user_id' => $request->user_id, 'title'=>'cart_'.$request->user_id, 'quantity' => 1, 'total_amount' => $amount, 'created_by' => $request->user_id, 'updated_by'=> $request->user_id ];

                        $checkUserCart = UserCarts::create($userCartArray);

                        if(!empty($checkUserCart)) {

                          $whereCondition = ['talent_id' => $request->talent_id, 'user_id' => $request->user_id , 'delete_flag' => 0];
                          $purchasedProductCart = PurchasedProduct::where($whereCondition)->get();

                          if(empty($purchasedProductCart)) {

                               $purchasedProductArray = ['user_id' => $request->user_id, 'cart_id' => $checkUserCart['id'], 'title' => $title,'unit_price' => $amount, 'quantity' => 1, 'total_amount' => $amount];
                               $created = PurchasedProduct::create($purchasedProductArray);
                          }
                        }
                    }

                    /************ check cart again *********/
                    $cartCondition = ['status_id' => 1, 'user_id' => $request->user_id, 'active' => 0];
                    $checkCart = UserCarts::where($cartCondition)->first();
                    if(!empty($checkCart)){

                        $whereCondition = ['talent_id' => $request->talent_id, 'user_id'=> $request->user_id, 'delete_flag' => 0];
                        $purchasedProductCart = PurchasedProduct::where($whereCondition)->count();

                        if(empty($purchasedProductCart)) {

                           $createArray = ['talent_id' => $request->talent_id, 'user_id'=> $request->user_id, 'cart_id'=> $checkCart['id'], 'title'=> $title, 'unit_price'=> $amount, 'quantity'=> 1, 'total_amount'=> $amount];

                           $addedToCart = PurchasedProduct::insertGetId($createArray);

                           if(!empty($addedToCart)) {
                            
                              $condition = ['user_id' => $request->user_id, 'delete_flag'=> '0'];
                              $data = PurchasedProduct::where($condition)->get();
                              $total_amount = $data->sum('total_amount');
                              $quantity = $data->sum('quantity');

                              $updateArray = ['quantity' => $quantity, 'total_amount'=> $total_amount, 'updated_at' => Carbon::now()];
                              
                              $whereCondition = ['id' => $data[0]->cart_id, 'user_id' =>$request->user_id, 'active'=> 0];
                              $update = UserCarts::where($whereCondition)->where('status_id','<>',3)->update($updateArray);
                               
                              return $this->respond([
                                  'status' => 'success',
                                  'status_code' => $this->getStatusCode(),
                                  'message' => 'Product added to cart.',
                              ]);

                           }
                        } else {

                            return $this->respond([
                                'status' => 'Info',
                                'status_code' => $this->getStatusCode(),
                                'message' => 'Product already in the cart.',
                            ]);

                        }
                    }

                }
           }


        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
