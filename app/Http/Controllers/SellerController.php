<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\UsersRoles;
use App\Models\SellerInboxes;
use App\Models\TalentDownloads;
use App\Models\SocialAccounts;
use App\Models\BuyerProduct;
use App\Models\SampleMedia;
use App\Models\ProductMedia;
use App\Models\CommercialMedia;
use App\Models\Plans;
use App\Models\SellerPlans;
use App\Models\CommercialAds;
use App\Models\CommercialAdViews;
use App\Models\Talents;
use App\Models\TalentAwards;
use App\Models\SellerContacts;
use App\Models\CustomPlans;
use App\Models\BuyerProducts;
use App\Models\TalentCatagory;
use App\Models\PromoteProducts;
use App\Models\SocialPromoteUsers;
use App\Models\SocialShares;
use App\Models\SellerStripeAccounts;
use App\Models\PurchasedProduct;
use App\Models\Chats;
use Session;
use Route;
use Response;
use Carbon\Carbon;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Traits\MailsendTrait;
use Illuminate\Support\Facades\Crypt;

class SellerController extends Controller {

    use MailsendTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {

            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $talentAwardUsers = [];
            $condition = ['id' => $id];
            $userInfo = User::with('getUserRole', 'getMessages', 'getSocialAccounts')->Where($condition)->get();
            $talentCondition = ['user_id' => $id, 'active' => 'Active'];
            $talents = Talents::where($talentCondition)->get();
            if (!empty($talents)) {
                $talentIdsArray = [];
                $talendAwardUsers = [];
                foreach ($talents as $key => $value) {
                    array_push($talentIdsArray, $value->id);
                }
                $talendAwardUsers = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->get();
            }
            $custom = ['title' => 'Future Starr | Seller Dashboard'];
            return view('frontend.seller.dashboard.index', compact('userInfo', 'talendAwardUsers', 'custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        if(Auth::check()) {
              $profileData = [];
              $profileData = Auth::user();
              $custom = ['title' => 'Future Starr | Edit Seller Account'];
              return view('frontend.seller.profile.index', compact('profileData','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
	
	public function profile() {
        if(Auth::check()) {
              $profileData = [];
              $profileData = Auth::user();
              $custom = ['title' => 'Future Starr | Edit Seller Account'];
              return view('frontend.seller.profile.profile', compact('profileData','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        if (!empty(Auth::check())) {
            if (!empty($request->all())) {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $request->validate([
                    'username' => 'required', 
                    'seller_bio_information' => 'required', 
                    'first_name' => 'required',
                    'last_name' => 'required', 
                    'email' => 'required|email|unique:users,email,' . $id,
                    'address' => 'required', 
                    'city' => 'required',
                    'state' => 'required', 
                    'zip_code' => 'required', 
                    'phone' => 'required'
                 ]);
                try {
                      if ($request->hasFile('profile_pic')) {
                          $image = $request->file('profile_pic');
                        
                          $extension = $image->extension();
                          $name = md5($image->getClientOriginalName()). '.' .$extension;
                        
                        $destinationPath = public_path('/userImage');
                        chmod($image->move($destinationPath, $name), 0777);
                        $imageName = 'userImage/'.$name;
                     } else if(!empty($request['old_image'])){
                         $imageName = $request['old_image'];
                     }    else {
                         $imageName = '';
                     }
                    $user = user::findOrFail($id);
                    $user->username = $request['username'];
                    $user->description = $request['buyer_bio_information'];
                    $user->first_name = $request['first_name'];
                    $user->last_name = $request['last_name'];
                    $user->profile_pic = $imageName;
                    $user->email = $request['email'];
                    $user->address = $request['address'];
                    $user->city = $request['city'];
                    $user->state = $request['state'];
                    $user->zip_code = $request['zip_code'];
                    $user->phone = $request['phone'];
                    $user->save();
                    Session::flash('success', 'Profile updated successfully.');
                    return redirect('seller/account-setting');
                }
                catch(ModelNotFoundException $err) {
                    Session::flash('warning', 'Somethingwent wrong.unable to update the profile at a moment.');
                    return redirect('/seller/account-setting/');
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

	public function chatMessagees(Request $request) {
       if(!empty(Auth::check())) {
           $chats = Chats::with('getSenderProfile','getReciverProfile','getMessageCount','isFavroite')->where('sent_by', '=', Auth::user()->id)
            ->orWhere('received_by', '=', Auth::user()->id)
            ->orderBy('last_activity', 'desc')->get();
           //dd($chats);

		   $profileData = User::find(Auth::user()->id);
           $custom = ['title' => 'Future Starr | Seller Messages'];
           return view('frontend.seller.profile.message',compact('chats', 'profileData','custom'));

       }
    }

        /**
     * Function to load view for chnage password.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword() {
        if (!empty(Auth::check())) {
            $profileData = [];
            $profileData = Auth::user();
            $custom = ['title' => 'Future Starr | Seller Change Password'];
            return view('frontend.seller.profile.change-password',compact('profileData','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to set the new password.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setPassword(Request $request) {
        if (!empty(Auth::check())) {
            if ($request->all()) {
                $validatedData = $request->validate([
                    'current_password' => 'required|string|min:8',
                    'new_password' => 'required|string|min:8|confirmed',
                    'password_confirmation' => 'required']);
                if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                    // The passwords matches
                    Session::flash('warning', 'Your current password does not matches with the password you provided. Please try again.');
                    return redirect('/seller/change-password-buyer');
                }
                if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
                    //Current password and new password are same
                    Session::flash('error', 'New Password cannot be same as your current password. Please choose a different password.');
                    return redirect('/seller/change-password-buyer');
                }
                //Change Password
                $user = Auth::user();
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                Session::flash('success', 'Password changed successfully !');
                return redirect('/seller/change-password-buyer');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //

    }
    /**
     * Update Scoial Media Account Details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSocialMedia(Request $request) {
        if (!empty(Auth::check())) {
            if (!empty($request->all())) {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $socialAccountArray = ['user_id' => $id, 'facebook_link' => $request['facebook_link'], 'twitter_link' => $request['twitter_link'], 'insta_link' => $request['insta_link'], 'user_id' => $id];
                $checkAlreadyExist = SocialAccounts::where($condition)->first();
                if (!empty($checkAlreadyExist)) {
                    $sociallAccounts = SocialAccounts::where($condition)->update($socialAccountArray);
                } else {
                    $sociallAccounts = SocialAccounts::create($socialAccountArray);
                }
                if (!empty($sociallAccounts)) {
                    $response = ['success' => 'Added successfully!!'];
                    return Response::json($response);
                } else {
                    $response = ['Error' => 'Error while adding message.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Commercial ads of Seller.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSellerAds(Request $request) {
        if (!empty(Auth::check())) {
            $commercialAds = [];
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $condition = ['user_id' => $id];
            $commercialAds = CommercialAds::where($condition)->with('getPlan', 'getSellerPlan', 'getAdsViews','custom')->get();
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /************* SELLER PURCHASE COMMERCIAL ADS ****************/
    /**
     * Fetch  Seller Plans details .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commercialAds(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $palns = [];
            $sellerPlan = [];
            $plans = Plans::all();
            $condition = ['user_id' => $id, 'end_date' => date('Y-m-d H:i:s') ];
            $sellerPlan = SellerPlans::where($condition)->orderBy('id', 'DESC')->first();
            $custom = ['title' => 'Future Starr | Seller Commercial Ad Dashboard'];
            return view('frontend.seller.commercial.index', compact('plans', 'sellerPlan','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to post the custom seller contact .
     *
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function postSellerContact(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if ($request->ajax()) {
                $rules = array('name' => 'required', 'email' => 'required', 'message' => 'required');
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                } else {
                    $createArray = ['user_id' => $id, 'username' => $request['name'], 'email' => $request['email'], 'description' => $request['message']];
                    $create = SellerContacts::create($createArray);
                    if (!empty($create)) {
                        $response = ['success' => 'Added successfully!!'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Unable to add contact.'];
                        return Response::json($response);
                    }
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to post custom plan.
     * payment method :  PAYPAL
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function postCustomPlan(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $rules = array('custom_plan' => 'required',);
            $customMessages = ['required' => 'Write something in textbox.'];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            if ($validator->fails()) {
                return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
            } else {
                $createArray = ['custom_plan' => $request['custom_plan'], 'user_id' => $id, 'created_by' => $id, 'updated_by' => $id];
                $create = CustomPlans::insert($createArray);
                if (!empty($create)) {
                    $message['content'] = $request['custom_plan'];
                    $this->customPlanMail($message);
                    $response = ['success' => 'Custom plan has been sent successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Error while sending custom plan.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /**
     * Function to purchase the commercial ads plan .
     * payment method :  PAYPAL
     * @param  int  success
     * @return \Illuminate\Http\Response
     */
    public function sellerSale(Request $request) {
        if (!empty(Auth::check())) {
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
                ->get();

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

            $downloads = BuyerProducts::where('user_id', $id)->get();
            $saleInformation = ['dailySales' => $dailySales, 'dailyRevenue' => $dailyRevenue, 'totalRevenue' => $totalRevenue, 'downloads' => $downloads];
            $custom = ['title' => 'Future Starr | Seller Sales Dashboard'];
            return view('frontend.seller.sales.index', compact('saleInformation','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    /******* MY DELETED PRODUCTS SECTION FUNCTIONS START ***********/

    public function getSellerDeletedProduct(Request $request, $days = '') {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = !empty($request->segment(4)) ? $request->segment(4) : 0;
            $newDay = ($days - 1);
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                $talents = Talents::with('getTalentCategories', 'user')->where($whereCondition)->where('talents.date', '<=', $today_date)->where('talents.date', '>=', $end_date)->orderBy('id', 'DESC')->paginate(5);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'Deactive'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate(5);
            }
            $custom = ['title' => 'Future Starr | Seller Deleted Products'];
            return view('frontend.seller.products.deleted-product', compact('talents','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    public function deleteMyProductUndo(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentArray = ['active' => 'Active'];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    $response = ['success' => 'Deleted product recovered successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to undo the products.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    public function deleteMyProductPermanently(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentsDeleted = Talents::WhereIn('id', $talentId)->delete();
                if (!empty($talentsDeleted)) {
                    $response = ['success' => 'Product deleted permanently.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to delete the products.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /******* MY DELETED PRODUCTS SECTION FUNCTIONS END ***********/

    /******* SELLER  PRODUCT ALL, ADD, EDIT, DELETE START ********/

    public function SellerProducts(Request $request, $days = '') {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = !empty($request->segment(4)) ? $request->segment(4) : 0;
            $newDay = ($days - 1);
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                $talents = Talents::with('getTalentCategories', 'user')->where($whereCondition)->where('talents.date', '<=', $today_date)->where('talents.date', '>=', $end_date)->orderBy('id', 'DESC')->paginate(5);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'Active'];
                $talents = Talents::where($whereCondition)->orderBy('id', 'DESC')->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->whereHas('getUserData', function ($query) {
                    $query->where('users.id', '!=', '');
                })->paginate(5);
            }
            //dd($talents);
            $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$id)->first();
            if(!empty($checkSellerStripeAccount)) {
                 Session::put('isOpen', true);
            } else  { Session::put('isOpen', false); }
            $custom = ['title' => 'Future Starr | Seller Product Section'];
            return view('frontend.seller.products.index', compact('talents','checkSellerStripeAccount','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function deleteMyProduct(Request $request) {
        if (Auth::check()) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if ($request->ajax()) {
                if (!empty($request->all())) {
                    try {
                        $condition = ['id' => $request['talent_id']];
                        $checkProduct = Talents::where($condition)->first();
                        if (!empty($checkProduct)) {
                            $talentArray = ['active' => 'Deactive'];
                            $updatedId = Talents::where($condition)->update($talentArray);
                            if (!empty($updatedId)) {
                                $response = ['success' => 'Product deleted successfully.'];
                                return Response::json($response);
                            } else {
                                $response = ['error' => 'Unable to delete the product.'];
                                return Response::json($response);
                            }
                        }
                    }
                    catch(ModelNotFoundException $err) {
                        $response = ['warning' => 'Something went wrong.Unable to delete the Product at a moment.'];
                        return Response::json($response);
                    }
                }
            } else {
                Session::flash('warning', 'Bad Request');
                return redirect('/');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function bulkDeleteProducts(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            if (!empty($request->all())) {
                $talentId = explode(",", $request['talent_id']);
                $talentArray = ['active' => 'Deactive'];
                $talentsDeleted = Talents::WhereIn('id', $talentId)->update($talentArray);
                if (!empty($talentsDeleted)) {
                    $response = ['success' => 'Deleted successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to deleted the products.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function addProduct(Request $request) {
        $id = !empty(Auth::user()->id)?Auth::user()->id:'';
        $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$id)->first();
        if(empty($checkSellerStripeAccount)) {
               $custom = ['title' => 'Future Starr | Add Product Section'];
               return redirect(route('seller.my-product','custom'));
        } else {
            $catagories = TalentCatagory::all();
            $custom = ['title' => 'Future Starr | Add Product Section'];
            return view('frontend.seller.products.forms.form', compact('catagories','custom'));
        }
    }
    
    public function storeProduct(Request $request) {
        if(!empty(Auth::check())){

            try {

                if (!empty($request->all())) {

                    $request->validate([
                           'category' => 'required',
                           'title' => 'required|unique:talents,title',
                           'description' => 'required',
                           'price' => 'required',
                           'product_info' => 'required',
                           'facebookLink' => 'required',
                           'instagramLink' => 'required',
                           'twitterLink' => 'required',
                           'video' => 'required',
                           'pdf' => 'required',
                           'commercial' => 'required',
                           'productright' => 'required',
                        ]);
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

                        if ($request->hasFile('video')) {
                            $video = $request->file('video');
    
                            $extension = $video->extension();
                            $fileName = md5($video->getClientOriginalName()). '.' .$extension;

                            $pathName = ('uploads/seller-video/' . $fileName);
                            $video->move('uploads/seller-video/', $fileName);
                            
                            $sampleMediaArray = ['talent_id' => $talentInsert, 'path_name' => $pathName, 'video_name' => $fileName];
                            $sampleMediaPath = $pathName;
                            $insertSampleMedia = SampleMedia::insert($sampleMediaArray);

                        }
                        if ($request->hasFile('pdf')) {
                            $pdf = $request->file('pdf');
                            
                            $extension = $pdf->extension();
                            $fileName = md5($pdf->getClientOriginalName()). '.' .$extension;

                            $pathName = ('uploads/seller-product-media/'.$fileName);
                            $path = storage_path();
                            $pdf->move('uploads/seller-product-media/', $fileName);
                           
                            $productMediaArray = ['talent_id' => $talentInsert, 'pdf_name' => $fileName, 'pdf_path' => $pathName];
                            $productMedia = $pathName;

                            $insertProductMedia = ProductMedia::create($productMediaArray);

                        }
                        if ($request->hasFile('commercial')) {
                            $commercial = $request->file('commercial');
                            
                            $extension = $commercial->extension();
                            $fileName = md5($commercial->getClientOriginalName()). '.' .$extension;

                            $path = storage_path();
                            $pathName = ('uploads/commercial-product/' . $fileName);
                            $commercial->move('uploads/commercial-product/', $fileName);
                            
                            $commercialMediaArray = ['talent_id' => $talentInsert, 'image_name' => $fileName, 'image_path' => $pathName];
                            $commercialMedia = $pathName;

                            $insertCommercilaMedia = CommercialMedia::insert($commercialMediaArray);

                        }
                        $user = User::find(Auth::user()->id);

                        if (!empty($user)) {
                            
                            $categoryName = TalentCatagory::pluck('name')->first();
                            
                            $commercialMedia = asset($sampleMediaPath);
                            $sampleMedia = asset($productMedia);
                            $uploadedProduct = asset($commercialMedia);

                            $data = array('talent_id' => $talentInsert, 'title' => $request['title'], 'description' => $request['product_info'], 'category' => $categoryName, 'price' => $request['price'], 'seller_name' => $user->first_name . " " . $user->last_name, 'pathToImage' => '', 'commercialMedia'=> $commercialMedia, 'sampleMedia' => $sampleMedia, 'productMedia' => $uploadedProduct , 'slug' => \Str::slug($request['title']));

                           /** Mail goes to admin to approve the talent ****/
                            $this->talentApprovalMail($data);

                        }
                        Session::flash('success', 'Product added successfully and sent for the admin approval.');
                        return redirect(route('seller.my-product'));
                    } else {
                        Session::flash('error', 'Error while adding the product.');
                        return redirect(route('seller.my-product'));
                    }
                }
            }
            catch(ModelNotFoundException $err) {
                Session::flash('warning', 'Somethingwent wrong.unable to update the profile at a moment.');
                return redirect('/buyer/account-setting/');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }


    public function editProduct(Request $request, $id = '') 
    {

        if(!empty(Auth::check()))
        {
             $user_id = Auth::user()->id;
             $checkSellerStripeAccount = SellerStripeAccounts::where('user_id','=',$user_id)->first();

             if(empty($checkSellerStripeAccount))
             {
                Session::flash('info', 'Your stripe account is not connected with future starr.');
                return redirect(route('seller.my-product'));

             } else {

                 /** find talent **/
                 $talents = [];
                 $talentCategories = [];

                 $whereCondition = ['user_id' => $user_id, 'id' => $id, 'active' => 'Active'];
                 $talent = Talents::where($whereCondition)->with('getUserData', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->first();
                 
                 if(!empty($talent))
                 {
                    if(empty($talent['approved'])) {
                        
                        Session::flash('info', 'Your product is under admin approvel process.');
                        return redirect(route('seller.my-product'));

                    } else {

                        $talentCategories = TalentCatagory::all();
                        $custom = ['title' => 'Future Starr | Seller Edit Product Section'];
                        return view('frontend.seller.products.edit', compact('talent', 'talentCategories','custom'));
                   }

                 } else {
                       
                       Session::flash('error', "No product found.");
                       return redirect(route('seller.my-product'));
                 }
            }

        }  else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }

    }

   
    public function updateProduct(Request $request) {

        if (!empty(Auth()->check())) {

            $userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
           
            if (!empty($request->all())) {
               
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
               
                try {
                    $request->validate([
                           'category' => 'required',
                           'title' => 'required|unique:talents,title,'.$request['talent_id'],
                           'description' => 'required',
                           'price' => 'required',
                           'product_info' => 'required',
                    ]);
                    $productArray = ['user_id'=>Auth::user()->id, 'talent_category_id' => $request['category'], 'title' => $request['title'], 'slug' => \Str::slug($request['title']), 'description' => $request['description'], 'price' => $request['price'], 'product_info' => $request['product_info'], 'created_by' => Auth::user()->id, 'updated_by' => Auth::user()->id, 'date' => Carbon::now()->format('Y-m-d') ];
                    $whereCondition = ['active' =>'Active' ,'id' => $request['talent_id']];

                    $updated = Talents::where($whereCondition)->update($productArray);
                    if(!empty($updated)) {
                        $updateCondtion  = ['talent_id' => $request['talent_id']];

                        if ($request->hasFile('video')) {

                            $video = $request->file('video');
                            
                            $extension = $video->extension();
                            $fileName = md5($video->getClientOriginalName()). '.' .$extension;

                            $pathName = ('uploads/seller-video/' . $fileName);
                            $path = storage_path();
                            $video->move('uploads/seller-video/', $fileName);

                            $sampleMediaArray = ['talent_id' => $request['talent_id'], 'path_name' => $pathName, 'video_name' => $fileName];
                            $insertSampleMedia = SampleMedia::where($updateCondtion)->update($sampleMediaArray);

                        }
                        if ($request->hasFile('pdf')) {
                            $pdf = $request->file('pdf');
                            
                            $extension = $pdf->extension();
                            $fileName = md5($pdf->getClientOriginalName()). '.' .$extension;

                            $pathName = ('uploads/seller-product-media/'.$fileName);
                            $path = storage_path();
                            $pdf->move('uploads/seller-product-media/', $fileName);
                            
                            $productMediaArray = ['talent_id' => $request['talent_id'], 'pdf_name' => $fileName, 'pdf_path' => $pathName];
                            $insertProductMedia = ProductMedia::where($updateCondtion)->update($productMediaArray);

                        }
                        if ($request->hasFile('commercial')) {
                            $commercial = $request->file('commercial');
                            
                            $extension = $commercial->extension();
                            $fileName = md5($commercial->getClientOriginalName()). '.' .$extension;

                            $path = storage_path();
                            $pathName = ('uploads/commercial-product/' . $fileName);
                            $commercial->move('uploads/commercial-product/', $fileName);
                            
                            $commercialMediaArray = ['talent_id' => $request['talent_id'], 'image_name' => $fileName, 'image_path' => $pathName];
                            $insertCommercilaMedia = CommercialMedia::where($updateCondtion)->update($commercialMediaArray);

                        }

                        Session::flash('success', 'Product updated successfully.');
                        return redirect(route('seller.my-product'));
                    }
                }
                catch(ModelNotFoundException $err) {
                    Session::flash('error', 'Unable to update the product.');
                    return redirect(route('seller.my-product'));
                }
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    /******* SELLER  PRODUCT ALL, ADD, EDIT, DELETE END ********/

    /****************** COMMERCIAL DASHBOARD FUNCTION*************/

    public function commercialAdDashboard(Request $request) {
        if (!empty(Auth::check())) {
            $sellerAds = [];
            $activePlan = [];
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $sellerAds = CommercialAds::with('getSellerPlan','getPlanDetail','adViews')->where('user_id', '=', $id)->orderBy('id', 'DESC')->get();
            $activePlanWhere = ['user_id' => Auth::user()->id];
            $today = date('Y-m-d h:i:s');
            $activePlan = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
            
            $custom = ['title' => 'Future Starr | Seller Commercial Ad Dashboard'];
            return view('frontend.seller.commercial.commercial-ad-dashboard', compact('sellerAds','activePlan','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function addCommercilaAds(Request $request) {
        if(Auth::check()==true){
              $getSellerTalents = Talents::where('user_id','=', Auth::user()->id)->get();
              $custom = ['title' => 'Future Starr | Seller Add Commercial Ads'];
              return view('frontend.seller.commercial.add-commercial-ads', compact('getSellerTalents','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function storeCommercialAd(Request $request){
         if (!empty(Auth::check())) {
            /*dd($request->all());*/
            $request->validate([
                           'title' => 'required',
                           'banner' => 'required|mimes:jpg,jpeg,png,mkv,mp4,wav|max:5000',
                           'product' => 'required',
                           'product_url' => 'required'
                    ]);
            if($request->has('banner')) {
                    $video = $request->file('banner');
                    
                    $extension = $video->extension();
                    $fileName = md5($video->getClientOriginalName()). '.' .$extension;
                    
                    $pathName = ('uploads/commercial-ads/' . $fileName);
                    $path = storage_path();
                    $video->move('uploads/commercial-ads/', $fileName);
            }
            $currentSellerPlan = SellerPlans::where('user_id', '=', Auth::user()->id)->first();
            
            if(!empty($currentSellerPlan)) {
                $adMediaArray =  [
                               'seller_plan_id' => $currentSellerPlan['id'],
                               'user_id' => Auth::user()->id,
                               'description' => $request['title'],
                               'video_name' => $fileName,
                               'video_path' => $pathName,
                               'product_id' => $request['product'],
                               'product_url' => $request['product_url'],
                               'created_by' => Auth::user()->id,
                               'updated_by' => Auth::user()->id
                            ];
                $addCommercilaAds = CommercialAds::insert($adMediaArray);
                if($addCommercilaAds) {
                     Session::flash('success', 'Ad added successfully.');
                     return redirect(route('seller.commercial-ads-dashboard'));
                } else {
                     Session::flash('error', 'Unable to add ad at a moment.');
                     return redirect(route('seller.addCommercilaAds'));
                }
            } else {
                     Session::flash('error', 'Unable to process your request.You do not have any active plan yet.');
                     return redirect(route('seller.commercial-ads-dashboard'));
            }
         } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
         }
    }

    /************************** END ******************************/

    /****************** PROMOTE PRODUCT START ********************/

    public function getPromoteProduct(Request $request) {
        if (!empty(Auth::check())) {
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $days = !empty($request->segment(4)) ? $request->segment(4) : 0;
            $newDay = ($days - 1);
            $today_date = Carbon::now()->format('Y-m-d');
            $end_date = Carbon::now()->subDays($newDay)->format('Y-m-d');
            if (!empty($days) && $days > 0) {
                $whereCondition = ['user_id' => $id, 'active' => 'true'];
                $products = PromoteProducts::with('getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->where($whereCondition)->where('date', '<=', $today_date)->where('date', '>=', $end_date)->orderBy('id', 'DESC')->paginate(5);
            } else {
                $whereCondition = ['user_id' => $id, 'active' => 'true'];
                $products = PromoteProducts::with('getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia', 'getTalentAwards')->where($whereCondition)->orderBy('id', 'DESC')->whereHas('getTalent', function ($query) {
                    $query->where('id', '!=', '');
                })->paginate(5);
            }
            //dd($products);
            $custom = ['title' => 'Future Starr | Seller Promoted Product Section'];
            return view('frontend.seller.products.promote-product', compact('products','custom'));
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect(route('seller.promote-product'));
        }
    }

    public function postPromoteProduct(Request $request) {

        if(!empty(Auth::check())) {
          $id = !empty(Auth::user()->id)?Auth::user()->id:'';
          if(!empty($request->all())) {

            $rules = [
                        'title' => 'required',
                        'message' => 'required',
                        'social_name' => 'required',
                     ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);

            }  else {
                $promoteProductArray = [
                               'user_id' => $id,
                               'talent_id' => $request['talent_id'],
                               'social_id' => $request['social_name'],
                               'title' => $request['title'] ,
                               'message' => $request['message'] ,
                               'date' => Carbon::now()->format('Y-m-d'),
                            ];

                $promoteProduct = PromoteProducts::insertGetId($promoteProductArray);
                   if(!empty($promoteProduct)) {
                       $socialShareArray = [
                                    'name' => $request['social_name'],
                                    'created_by' => $id,
                                    'updated_by' => $id
                                  ];
                       $socialShares = SocialShares::insertGetId($socialShareArray);
                       if(!empty($socialShares)) {
                           $socialPromoteArray = [
                                  'promote_id' => $promoteProduct,
                                  'social_share_id' =>  $socialShares
                            ];
                        $inserted = SocialPromoteUsers::create($socialPromoteArray);
                        if(!empty($inserted)) {
                               $response = ['success' => 'Product promoted successfully.'];
                        return Response::json($response);
                        } else {
                        $response = ['error' => 'Error in promoting product.'];
                        return Response::json($response);
                        }
                    }
                }
            }
          }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

   public function editPromoteProduct(Request $request) {
        if(!empty(Auth::check())){
            $userId =  !empty(Auth::user()->id)?Auth::user()->id:'';
            if(!empty($request->all())) {
                $rules = [
                            'title' => 'required',
                            'message' => 'required',
                            'social_name' => 'required',
                         ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);
                }  else {
                    $updateArray = [
                                      'title' => $request['title'],
                                      'message' => $request['message'],
                                      'social_id' => $request['social_name'],
                                      'updated_at' => Carbon::now()
                                  ];
                    $whereCondition = ['user_id' => $userId , 'id'=> $request['promote_id']];
                    $updated  = PromoteProducts::where($whereCondition)->update($updateArray);
                    if(!empty($updated)) {
                        $response = ['success' => 'Promoted product updated successfully.'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Error while updation in product.'];
                        return Response::json($response);
                    }
                }
           }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
   }
   public function deletePromoteProduct(Request $request) {
        if(!empty(Auth::check())){
             if(!empty($request->all())) {
                  $condition = ['id' => $request['promote_id']];
                  $updateArray = ['active' => 'false'];
                  $deleted = PromoteProducts::where($condition)->update($updateArray);
                  if(!empty($deleted)) {
                        $response = ['success' => 'Product deleted permanently.'];
                        return Response::json($response);
                  } else {
                        $response = ['error' => 'Enable to delete Product.'];
                        return Response::json($response);
                  }
             }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
   }

    /**************** PROMOTE PRODUCT END *************************/

    public function imageUpload(Request $request){
        if(!empty(Auth::check())) {
           if($request->ajax()) {
             if($request->has('profile_pic')) {
                    $video = $request->file('profile_pic');
                    
                    $extension = $video->extension();
                    $fileName = md5($video->getClientOriginalName()). '.' .$extension;
                    
                    $pathName = ('userImage/' . $fileName);
                    $path = storage_path();
                    $video->move('userImage/', $fileName);
                    if(Auth::user()->profile_pic !='' && file_exists(Auth::user()->profile_pic)){
                         $file_path = public_path().'/'.Auth::user()->profile_pic;
                         unlink($file_path);
                    }
            }
            $updateProfileArray = ['profile_pic' => $pathName];
            $whereCondition = ['id' => Auth::user()->id];
            $updateProfile = User::where($whereCondition)->update($updateProfileArray);

            if (!empty($updateProfile)) {
                $response = ['success' => 'Profile picture updated successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Unable to update the profile picture.'];
                    return Response::json($response);
                }
           }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

     /**
     * Show the form for manage the public profile resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function public_profile(Request $request) {
        
        if (!empty(Auth::check())) {
             
            $data = [];
            $data = User::find(Auth::user()->id);

            return view('frontend.seller.profile.profile_data', compact('data'));

        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function public_profile_store(Request $request) {

        if(!empty(Auth::check())) {
            
             $image_data = $request['encode_image'];
              if(!empty($image_data)) {
                    $image_array_1 = explode(";", $image_data);
                    $image_array_2 = explode(",", $image_array_1[1]);
                    $data = base64_decode($image_array_2[1]);
                    $image_name = time().$request['author_first_name']. '.png';
                    $upload_path = public_path('userImage/banner/' . $image_name);      
                    file_put_contents($upload_path, $data);
                    $path_name = 'userImage/banner/' . $image_name;
                    
              } else {
                     $path_name = $request['db-banner-image'];
              }
            
             if($request->has('video_bio') ) {
                $video = $request->file('video_bio');
               
                $extension = $video->extension();
                $video_name = md5($video->getClientOriginalName()). '.' .$extension;

                $video_path = 'userImage/video-bio/'.$video_name;
                $video->move('userImage/video-bio/', $video_name);
                if($request['db-video-name'] != '' && file_exists($request['db-video-name'])){
                         unlink($request['db-video-name']);
                } 
              }  else {
                   $video_path = $request['db-video-name'];
              }
            if(file_exists($path_name) && file_exists($video_path)){

                 $table_array = [
                    'banner_image' => $path_name, 
                    'bio_video' => $video_path ,
                    'description' => $request['bio_info'] 
                ];
                 $update = User::where('id', Auth::user()->id)->update($table_array);
                 if(!empty($update)) {
                    Session::flash('success', 'Profile data updated successfully!');
                    return redirect()->back();
                 } else {
                     Session::flash('error', 'Unbale to process the request. Please try agian later.');
                     return redirect()->back();
                 }
            } else {
                Session::flash('error', 'Unable to upload the requested files. Please try agian later.');
                return redirect()->back();
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
     }
	 
	 /****** billing page *****/
	 public function accountinfo() {
       if(!empty(Auth::check())) {
           
		   
		   
           return view('frontend.seller.account-info');
            
       }
    }

}
