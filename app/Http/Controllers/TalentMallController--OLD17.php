<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Talents;
use App\Models\TalentAwards;
use App\Models\TalentRiders;
use App\Models\BuyerProducts;
use App\Models\BuyerContacts;
use App\Models\TalentComments;
use App\Models\PurchasedProduct;
use App\Models\TalentView;
use App\Models\UserCarts;
use App\User;
use App\Models\Metatags;
use Auth;
use Response;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Fanbase;
use DB;

use Illuminate\Support\Facades\Crypt;

class TalentMallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catagories = TalentCatagory::all();
        $metaTags =  Metatags::where('page_title','=','Talent Mall')->first();
        return view('frontend.talentmall.index',compact('catagories','metaTags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug ='')
    {
        if(!empty($request->all()) && $request->has('page') == '') {
            
            $talentList = '';
            $talentListArr = [];
            $price = !empty($request['price'])?$request['price']:0;
            $categories = !empty($request['categories'])?$request['categories']:0;
            $star = !empty($request['stars'])?$request['stars']:0;
            $min_price = 0;
            $max_price = $price;
            $condition = ['approved' => 1 , 'active' =>'Active'];
            
            if(empty($price) && empty($star)) {
                
                //DB::enableQueryLog();
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where($condition)->WhereIn('talent_category_id',$categories)->limit(9)->orderBy('id', 'DESC')->get();
                $query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where($condition)->WhereIn('talent_category_id',$categories)->get();
        
             } else if(!empty($price) && empty($star)) {
                
                //DB::enableQueryLog();
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where($condition)->WhereIn('talent_category_id',$categories)->whereBetween('price', [$min_price, $max_price])->limit(9)->orderBy('id', 'DESC')->get();
                $query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where($condition)->WhereIn('talent_category_id',$categories)->whereBetween('price', [$min_price, $max_price])->get();


             } else if(empty($price) && !empty($star)) {
                 
                 //DB::enableQueryLog();
                 $talents = Talents::with('user','commercialMedia','sampleMedia')->where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->limit(9)->orderBy('id', 'DESC')->get();
                //$query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->get();

             } else {
                
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->whereBetween('price', [$min_price, $max_price])->limit(9)->orderBy('id', 'DESC')->get();
               
               $totalCount = Talents::where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->whereBetween('price', [$min_price, $max_price])->get();
                
             }
           
            $return = [];
            $return[] = view('frontend.talentmall.ajax-list')->with(['talents' => $talents])->render();
            
            $return1 = [];
            $return1[] = view('frontend.talentmall.show-more-button')->with(['totalCount' => $totalCount, 'talents' => $talents ])->render();
            

            if(count($talents) == 0 ) {
                $customClass= "talent_list";
            } else {
                $customClass = "";
            }
            $response = ['talnets' => $return, 'customClass' => $customClass, 'load_more' => $return1 ];
            return Response::json($response);
        
        } else {

            $catagories = TalentCatagory::all();
            $talent_category_id  = TalentCatagory::where('slug','=',$slug)->first();

            if(!empty($talent_category_id)) {

                $id = $talent_category_id['id'];
                $condition = ['talent_category_id' => $id ,'approved' => 1 ,'active' =>'Active'];
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where($condition)->limit(9)->orderBy('id', 'DESC')->get();
                            $category = TalentCatagory::find($id);
                $whereArr =  ['type'=>'Categories','page_title'=> $category['name']];
                $metaTags =  Metatags::where($whereArr)->first();

                $totalCount = Talents::where($condition)->get();
                
                return view('frontend.talentmall.info',compact('catagories','id','talents','metaTags','category', 'totalCount'));
            } else {
                abort('404');
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showMoreTalent(Request $request) {

        if($request->ajax()) {
            
             $price = !empty($request['price'])?$request['price']:0;
             $categories = !empty($request['categories'])?$request['categories']:0;
             $star = !empty($request['stars'])?$request['stars']:0;
             $min_price = 0;
             $max_price = $price;
             $condition = ['approved' => 1 , 'active' =>'Active'];
             
            if(empty($price) && empty($star)) {
                
                //DB::enableQueryLog();
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->limit(9)->orderBy('id', 'DESC')->get();
                $query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->get();
        
             } else if(!empty($price) && empty($star)) {
                
                //DB::enableQueryLog();
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->whereBetween('price', [$min_price, $max_price])->limit(9)->orderBy('id', 'DESC')->get();
                $query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->whereBetween('price', [$min_price, $max_price])->get();


             } else if(empty($price) && !empty($star)) {
                 
                 //DB::enableQueryLog();
                 $talents = Talents::with('user','commercialMedia','sampleMedia')->where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->limit(9)->orderBy('id', 'DESC')->get();
                //$query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->get();

             } else {
                
                $talents = Talents::with('user','commercialMedia','sampleMedia')->where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->whereBetween('price', [$min_price, $max_price])->limit(9)->orderBy('id', 'DESC')->get();
               
               $totalCount = Talents::where('id', '<', $request->talent_id)->where($condition)->WhereIn('talent_category_id',$categories)->WhereIn('avg_rating', $star)->whereBetween('price', [$min_price, $max_price])->get();
                
             }

             $return = [];
             $return[] = view('frontend.talentmall.ajax-list')->with(['talents' => $talents])->render();
            
             $return1 = [];
             $return1[] = view('frontend.talentmall.show-more-button')->with(['totalCount' => $totalCount, 'talents' => $talents ])->render();
             
            if(count($talents) == 0 ) {
                $customClass= "talent_list";
            } else {
                $customClass = "";
            }

            $response = ['talnets' => $return, 'customClass' => $customClass, 'load_more' => $return1 ];
            return Response::json($response);

        }
    }
    

    /**
     * Display the specified resource with ajax. 
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */

    public function getTalentByCat(Request $request)
    {
        if($request->ajax()){
            $talents = Talents::with('user','commercialMedia')->whereIn('catagory_id',$request->selectedCat)->paginate(10);
            
            return view('frontend.talentmall.ajax-list',compact('talents'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //->where('talents.approved', '=', '1')
    }
    
    public function productInfo(Request $request, $id){
        
             if(!empty($id) && is_string($id)) {

                $checkItemInCart = [];

                $talent  = Talents::where('slug', $id)->first();
               
                if(empty($talent)) {
                   return redirect('talent-mall');
                }

                /******** update product view's ********/
                
                $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                $whereCondition = ['ip_address' => $ip, 'talent_id' => $talent['id'] ];
                $talentView = TalentView::where($whereCondition)->first();
                
                if(empty($talentView)) {

                      $talentViewArray = ['talent_id' => $talent['id'] , 'ip_address' => $ip ];
                      $talentUpdated = TalentView::insert($talentViewArray);

                      $viewCount = $talent['view'];
                      $updatedCount = $viewCount + 1; 
                      $talentArray = ['view' => $updatedCount];
                      $updated = Talents::where('id', $talent['id'])->update($talentArray);
            
                }

                //$id = Crypt::decryptString($id);

                $condition = ['slug' => $id ,'approved' => 1 ,'active' =>'Active'];
                $talent = Talents::withCount(['getTalentRiders', 'getTalentAwards', 'getDownloads', 'talentComments'])->with('commercialMedia','sampleMedia', 'productMedia', 'talentComments', 'getUserData', 'getTalentAwards', 'getTalentRiders','getDownloads','alreadyAwarded','selfRider')->where($condition)->first();

                if(!empty($talent)) {
                    $talentInformation = $talent;
                } else {
                    return redirect('talent-mall');
                }

                $similarTalentCondition = ['talent_category_id' => $talentInformation['talent_category_id'], 'approved' => '1', 'active' =>'Active' ];
                $similarTalent = Talents::with('commercialMedia','sampleMedia')->where($similarTalentCondition)->where('slug','!=',$id)->whereHas('commercialMedia', function ($query) {
                    $query->where('commercial_media.talent_id', '!=', '');})->inRandomOrder()->limit(6)->get();
               // dd($similarTalent);
                if(!empty(Auth::check())) {
                   
                   $cartCondition = ['talent_id'=> $talentInformation['id'], 'user_id'=> Auth::user()->id, 'delete_flag'=> 0];
                   $checkItemInCart = PurchasedProduct::where($cartCondition)->count();
                }
                
                $metaTags = [];
                $metaTags = ['title' => $talentInformation['title'], 'description' =>  $talentInformation['product_info'], 'keywords' => $talentInformation['title'] ];

                return view('frontend.talentmall.product-info', compact('talentInformation','similarTalent','checkItemInCart', 'metaTags'));
            }
        
    }

    /**
     * Add award to specified talent.
     *
     * @param  post data
     * @return \Illuminate\Http\Response
     */
    public function giveTalentAward(Request $request) {
        if(!empty(Auth::check())) {
            try{
            $awardArray = [
                       'talent_id' => Crypt::decryptString($request['talent_id']), 
                       'user_id' => Auth::user()->id, 
                       'awards' =>  1, 
                   ];
            $condition = ['user_id' => Auth::user()->id,'talent_id' => Crypt::decryptString($request['talent_id']) ];
            $checkExist = TalentAwards::where($condition)->first();
            if(empty($checkExist)) {
                $insertedId  = TalentAwards::create($awardArray);
                if(!empty($insertedId)){
                    $response = ['success' => 'Award Added Successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Something went wrong.'];
                    return Response::json($response);
                }
            } else {
                $response = ['info' => 'You have already awarded this talent.'];
                    return Response::json($response);
                }
            
        } catch(ModelNotFoundException $err){
            $response = ['warning' => 'Somethingwent wrong.unable to add the award at a moment.'];
            return Response::json($response);
        }  
        } else {
             Session::flash('info', 'You must be login firstly.');
             return redirect('/');
        }
    }

    /**
     * Add rider to specified talent.
     *
     * @param  post data
     * @return \Illuminate\Http\Response
     */
    public function addRiderToTalent(Request $request) {

        if(!empty(Auth::check())) {
            
            try{
                
                $talent_by = Talents::where('id', Crypt::decryptString($request['talent_id']) )->pluck('user_id')->first();
                
                $riderArray = [
                           'talent_id' => Crypt::decryptString($request['talent_id']),
                           'talent_by' => $talent_by, 
                           'user_id' => Auth::user()->id, 
                           'rider' =>  1, 
                 ];
                 
                $condition = ['user_id' => Auth::user()->id,'talent_id' => Crypt::decryptString($request['talent_id']) ];

                $checkExist = TalentRiders::where($condition)->first();

                if(empty($checkExist)) {
                    $insertedId  = TalentRiders::create($riderArray);
                   

                    if(!empty($insertedId)){
                        
                        $posted_by = Talents::where('id', Crypt::decryptString($request['talent_id']) )->pluck('user_id')->first();

                        $fan_where =  ['follower' => Auth::user()->id, 'following' => $posted_by ];
                        $checkFanbase = Fanbase::where($fan_where)->first();

                        if(empty($checkFanbase)) {
                            $fanbase = ['follower' => Auth::user()->id, 'following' => $posted_by ];
                            $insert = Fanbase::create($fanbase);

                        }

                        $response = ['success' => 'Rider Added Successfully.'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Something went wrong.'];
                        return Response::json($response);
                    }
                } else  {
                    $response = ['info' => 'You are already a rider to this talent.'];
                        return Response::json($response);
                    }

            } catch(ModelNotFoundException $err){
                $response = ['warning' => 'Somethingwent wrong.unable to add the award at a moment.'];
                return Response::json($response);
            }             
        } else {
              Session::flash('info', 'You must be login firstly.');
              return redirect(url()->full());
        }
 
    }
    /**
     * Add the Buyer messages to talent..
     *
     * @param  request all
     * @return \Illuminate\Http\Response
     */
    public function addBuyerContactMessage(Request $request) {
        if (!empty(Auth::check())) {
            if ($request->ajax()) {
                //dd($request->all());
                $rules = array('message_title' => 'required', 'message' => 'required');
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                } else {
                    $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                    $messageArray = ['user_id' => $id, 'talent_id' => $request['talent_id'], 'msg_title' => $request['message_title'], 'message' => $request['message'], 'created_by' => $id, 'updated_by' => $id];
                    $buyerContacts = BuyerContacts::create($messageArray);
                    if (!empty($buyerContacts)) {
                        $response = ['success' => 'Message added successfully!!'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Error while adding message.'];
                        return Response::json($response);
                    }
                }
            } else {
                $response = ['error' => 'Bad Request'];
                return Response::json($response);
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function addTalentToCart(Request $request) {
        if(!empty(Auth::check())) {
             if(!empty($request->all())) {
                 $talent = Talents::where('id','=',$request['talent_id'])->first();
                 $title = $talent['title'];
                 $amount = $talent['price'];
                 $condition = ['buyer_id' => Auth::user()->id, 'talent_id'=> $request['talent_id'], 'active'=> 1];
                 $checkAlreadyPurhased = BuyerProducts::where($condition)->count();
                 if(!empty($checkAlreadyPurhased)) {
                    $response = ['info' => 'You have already purchased this product.'];
                    return Response::json($response);
                 } else {

                    $cartCondition = ['status_id'=>1, 'user_id'=>Auth::user()->id, 'active'=>0];
                    $checkCart = UserCarts::where($cartCondition)->where('status_id','<>','3')->get();
                   
                    if(count($checkCart)==0) {
                        
                        $userCartArray = ['user_id'=> Auth::user()->id, 'title'=>'cart_'.Auth::user()->id,'quantity'=>1, 'total_amount'=>$amount, 'created_by'=> Auth::user()->id, 'updated_by'=> Auth::user()->id];
                        $checkUserCart = UserCarts::create($userCartArray);
                        if(!empty($checkUserCart)){
                          $whereCondition = ['talent_id' => $request['talent_id'],'user_id'=> Auth::user()->id, 'delete_flag'=>0];
                          $purchasedProductCart = PurchasedProduct::where($whereCondition)->get();
                          if(empty($purchasedProductCart)) {
                               $purchasedProductArray = ['user_id'=>Auth::user()->id, 'cart_id'=> $checkUserCart['id'], 'title'=> $title,'unit_price'=> $amount, 'quantity'=>1, 'total_amount' =>$amount];
                               $created = PurchasedProduct::create($purchasedProductArray);
                          }
                        }
                    }

                    /************ check cart again *********/
                    $cartCondition = ['status_id'=>1, 'user_id'=>Auth::user()->id, 'active'=>0];
                    $checkCart = UserCarts::where($cartCondition)->first();
                    if(!empty($checkCart)){

                        $whereCondition = ['talent_id' => $request['talent_id'],'user_id'=> Auth::user()->id, 'delete_flag'=>0];
                        $purchasedProductCart = PurchasedProduct::where($whereCondition)->count();
                        if(empty($purchasedProductCart)){
                           $createArray = ['talent_id' => $request['talent_id'], 'user_id'=> Auth::user()->id, 'cart_id'=> $checkCart['id'], 'title'=> $title, 'unit_price'=> $amount, 'quantity'=> 1, 'total_amount'=> $amount];

                           $addedToCart = PurchasedProduct::insertGetId($createArray);
                           if(!empty($addedToCart)) {
                              $condition = ['user_id'=>Auth::user()->id, 'delete_flag'=>'0'];
                              $data = PurchasedProduct::where($condition)->get();
                              $total_amount = $data->sum('total_amount');
                              $quantity = $data->sum('quantity');
                              $updateArray = ['quantity' =>$quantity, 'total_amount'=>$total_amount, 'updated_at' =>Carbon::now()];
                              $whereCondition = ['id' => $data[0]->cart_id, 'user_id'=>Auth::user()->id, 'active'=> 0];
                              $update = UserCarts::where($whereCondition)->where('status_id','<>',3)->update($updateArray);
                              $response = ['success' => 'Product added to cart.'];
                              return Response::json($response);
                           }
                        } else {
                              $response = ['info' => 'Product already in cart.'];
                              return Response::json($response);
                        }
                    } 
                 }
             }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function productUrl(Request $request) {

        if(!empty($request->all())) {
             
             $product_url = route('talent.productInfo', Crypt::encryptString($request->id));
             $response = ['url' => $product_url];
             return Response::json($response);

        }
    }
}

