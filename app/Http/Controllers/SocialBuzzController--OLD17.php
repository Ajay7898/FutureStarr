<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TalentCatagory;
use App\Models\SocialBuzz;
use App\Models\SocialBuzzComments;
use App\Models\SocialBuzzReplies;
use App\Models\SocialBuzzRiders;
use App\Models\SocialBuzzAwards;
use App\Models\SocialBuzzReports;
use App\Models\CommercialAds;
use App\Models\Metatags;
use App\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use Session;
use Response;
use Helpers\Customhelper;
use App\Traits\MailsendTrait;
use App\Models\CommercialAdViews;
use App\Models\SellerPlans;
use App\Models\Talents;
use App\Models\Fanbase;
use Illuminate\Support\Facades\Crypt;

class SocialBuzzController extends Controller {

    use MailsendTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat_id = '', Request $request) {

        if($request->ajax()) {
           
             $whereArr = array('category_id' => $request->category, 'active' => 1);
             $socialBuzzList = SocialBuzz::with('getUserData', 'getTalentCatagories', 'getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'alreadyAwarded', 'selfRider')->where('id', '<', $request->social_buzz_id)->Where($whereArr)->orderBy('id', 'DESC')->limit(10)->get();
             $check = Auth::check();

             $socialBuzzListCount = SocialBuzz::where('id', '<', $request->social_buzz_id)->Where($whereArr)->get();
             $count = count($socialBuzzListCount);

             $return = [];
             $return[] = view('frontend.socialbuzz.ajax-load-more-list')->with(['socialBuzzList' => $socialBuzzList, 'check' => $check])->render();
             
             $return1 = [];
             $return1[] = view('frontend.socialbuzz.show-more')->with(['socialBuzzList' => $socialBuzzList, 'category' => $request->category, 'count' => $count])->render();

             $response = ['social_buzz' => $return, 'category' => $return1, 'count' => $count];
             return Response::json($response);

        } else {

            $category_id = '';
            $getCategoryId = TalentCatagory::where('slug','=',$cat_id)->first();
            $category_id  = $getCategoryId['id'];
            $talentCategories = TalentCatagory::all();
            $socialBuzzList = array();
            $socialBuzzCount = '';

            if (count($talentCategories) > 0 && $category_id == '') {
                
                $firstCat = $talentCategories->first();
                $category_id = $firstCat['id'];
                $whereArr = array('category_id' => $category_id, 'active' => 1);
                $socialBuzzList = SocialBuzz::with('getUserData', 'getTalentCatagories', 'getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'alreadyAwarded', 'selfRider')->where($whereArr)->orderBy('id', 'DESC')->limit(10)->get();
                $metaTags = Metatags::where('page_title', '=', 'Social buzz')->first();
                $ads = getAds($category_id);

                $socialBuzzCount = SocialBuzz::where($whereArr)->count();

            } else {

                $whereArr = array('category_id' => $category_id, 'active' => 1);
                $socialBuzzList = SocialBuzz::with('getUserData', 'getTalentCatagories', 'getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'alreadyAwarded', 'selfRider')->where($whereArr)->orderBy('id', 'DESC')->limit(10)->get();
                $socialBuzzCount = SocialBuzz::where($whereArr)->count();
                if (!empty($socialBuzzList)) {
                    $categoryInfo = TalentCatagory::find($category_id);
                    $cName = $categoryInfo['name'];
                    $categoryName = isset($socialBuzzList[0]->getTalentCatagories['name']) ? $socialBuzzList[0]->getTalentCatagories['name'] : $cName;
                    $whereArr = ['type' => 'Categories', 'page_title' => $categoryName];
                    $metaTags = Metatags::where($whereArr)->first();
                }

               
            }

            $categoryInfo = TalentCatagory::find($category_id);
            $check = Auth::check();
            $ads = getAds($category_id);
            $firstCategory = $talentCategories->first();
            $products =[];
            $userId = !empty(Auth::user()->id)?Auth::user()->id:'';
            $talentCondition = ['user_id' => $userId, 'active'=>'Active'];
            $products  = Talents::where($talentCondition)->get();
            
            //dd($socialBuzzList);

            return view('frontend.socialbuzz.index', compact('talentCategories', 'socialBuzzList', 'check', 'categoryInfo', 'metaTags', 'firstCategory', 'ads','category_id','products', 'socialBuzzCount'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request) {

        //Code goes here
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        
        if (Auth::check() == true) {
                
            $request->validate([
                'comment' => 'required', 
                'profile_pic' => 'sometimes|mimes:jpeg,jpg,png,mp4,wav,mp3,mpeg|required'
            ]);

            try {
                
                if ($request->hasFile('profile_pic')) {
                    $image = $request->file('profile_pic');
                    $name = time() . '.' . $image->getClientOriginalName();
                    $destinationPath = public_path('/uploads/social-buzz/');
                    chmod($image->move($destinationPath, $name),0777);
                    $imageName = 'uploads/social-buzz/' . $name;
                } else {
                     $imageName = '';
                }
                $table_array  = [ 
                            'user_id' => Auth::user()->id, 
                            'category_id' => $request['category_id'], 
                            'comment' => $request['comment'], 
                            'product_link' => $request['product_link'], 
                            'product_img_path' => $imageName, 
                            'posted_by' => Auth::user()->id, 
                            'updated_by' => Auth::user()->id, 

                    ];
                
                $insertedId = SocialBuzz::create($table_array)->id;
                $findSlug = TalentCatagory::find($request['category_id']);
                if (!empty($insertedId)) {
                    Session::flash('success', 'Posted successfully.');
                    return redirect('/social-buzz/' . $findSlug['slug']);
                } else {
                    Session::flash('error', 'Something went wrong.');
                    return redirect('/social-buzz/' . $findSlug['slug']);
                }
            }
            catch(ModelNotFoundException $err) {
                Session::flash('warning', 'Somethingwent wrong.unable to add the sms at a moment.');
                return redirect('/social-buzz');
            }
            
        } else {
            Session::flash('warning', 'Please login to make the comment.');
            return redirect('/social-buzz/' . $request['category_id']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id) {
        
        // Code goes here
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id) {
        // code goes here
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        if(!empty(Auth::check())){
              if($request->ajax()){
                  //dd($request->all());
                    if($request->has('social_buzz_file')) {
                        $image = $request->file('social_buzz_file');
                        $name = time() . '.' . $image->getClientOriginalName();
                        $destinationPath = public_path('/uploads/social-buzz/');
                        chmod($image->move($destinationPath, $name),0777);
                        $imageName = 'uploads/social-buzz/' . $name;
                        if($request['previous_file'] !='' && file_exists($request['previous_file'])){
                             $file_path = public_path().'/'.$request['previous_file'];
                             unlink($file_path);
                        }       
                    } else {
                        $imageName = $request['previous_file'];
                    }
                    $udpateArray = [
                                     'comment' => $request['comment'] ,
                                     'product_link' => $request['product_link'],
                                     'product_img_path' =>$imageName,
                                   ];
                    $updateCondition = ['id'=> $request['social_buzz_id'], 'user_id' => Auth::user()->id];
                    $updated = SocialBuzz::where($updateCondition)->update($udpateArray);
                    if (!empty($updated)) {
                    $response = ['success' => 'Social Buzz Updated Successfully.'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Something went wrong.'];
                        return Response::json($response);
                    }
               }
        } else {
             Session::flash('info','You must be login first.');
             return redirect(route('/'));
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if(!empty(Auth::check())) { 
              if($request->ajax()) {
                 $id = $request['id'];
                 $deleted = SocialBuzz::where('id', '=', $id)->delete();
                 if(!empty($deleted)) {
                    $response = ['success' ,'Social Buzz deleted successfully!.'];
                    return Response::json($response);
                 } else {
                    $response = ['error' => 'Something went wrong.'];
                    return Response::json($response);
                 }
              }
        } else {
            Session::flash('info','You must be login first.');
            return redirect(route('/'));
        }
        
    }
    public function postBuzzAward(Request $request) {
        if (Auth::check() == true) {
            try {
                $award = 1;
                $award_data = new SocialBuzzAwards();
                $award_data->post_id = $request['post_id'];
                $award_data->user_id = Auth::user()->id;
                $award_data->award = $award;
                
                $award_data->save();
                $insertedId = $award_data->id;
                if (!empty($insertedId)) {
                    $response = ['success' => 'Award Added Successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Something went wrong.'];
                    return Response::json($response);
                }
            }
            catch(ModelNotFoundException $err) {
                $response = ['warning' => 'Somethingwent wrong.unable to add the award at a moment.'];
                return Response::json($response);
            }
        } else {
            Session::flash('warning', 'Please login to add the award.');
            return redirect('/social-buzz/');
        }
    }
    public function postBuzzRider(Request $request) {

        if (Auth::check() == true) {
            try {
                 
                $posted_by = SocialBuzz::where('id', $request['post_id'])->pluck('user_id')->first();
                
                $rider = 1;
                $rider_data = new SocialBuzzRiders();
                $rider_data->post_id = $request['post_id'];
                $rider_data->user_id = Auth::user()->id;
                $rider_data->social_buzz_by = $posted_by;
                $rider_data->platform = 'SocialBuzz';
                $rider_data->save();
                $insertedId = $rider_data->id;

                if (!empty($insertedId)) {

                    $fan_where =  ['follower' => Auth::user()->id, 'following' => $posted_by ];
                    $checkFanbase = Fanbase::where($fan_where)->first();
                    
                    if(empty($checkFanbase)){

                        $fanbase = ['follower' => Auth::user()->id, 'following' => $posted_by ];
                        $insert = Fanbase::create($fanbase);
                    }

                    $response = ['success' => 'Rider Added Successfully.'];
                    return Response::json($response);
                } else {
                    $response = ['error' => 'Something went wrong.'];
                    return Response::json($response);
                }
            }
            catch(ModelNotFoundException $err) {
                $response = ['warning' => 'Somethingwent wrong.unable to add the award at a moment.'];
                return Response::json($response);
            }
        } else {
            Session::flash('warning', 'Please login to add the rider.');
            return redirect('/social-buzz/');
        }
    }
    public function reportUser(Request $request) {
        if ($request->ajax()) {
            if (Auth::check() == true) {
                try {
                       
                        $table_array = array (
                           'post_id' => $request->post_id,
                            'user_id' => Auth::user()->id
                        );

                        $saved = SocialBuzzReports::create($table_array);
                        /*** REPORTER DATA START*******/
                        $reporter = User::find(Auth::user()->id);

                        $report_name = $reporter['first_name'] . ' ' . $reporter['last_name'];
                        $report_email = $reporter['email'];
                        /*** REPORTER DATA END*******/
                        /*** REPORT DATA START ******/
                        $whereArr = array('id' => $request->post_id, 'active' => 1);
                        $reportData = SocialBuzz::with('getUserData')->where($whereArr)->first();
                        $email = $reportData->getUserData['email'];
                        $name = $reportData->getUserData['first_name'] . ' ' . $reportData->getUserData['last_name'];
                        $comment = $reportData['comment'];
                        $created_at = $reportData->getUserData['created_at'];
                        /** REPORT DATA END **/
                       
                        /** EMAIL FUNCTION **/
                        $mail = $this->sendReportRequestMailToAdmin($email, $name, $comment, $report_name, $report_email);
                }
                catch(ModelNotFoundException $err) {
                    $response = ['warning' => 'Something went wrong.unable to add the report at a moment.'];
                    return Response::json($response);
                }
            } else {
                Session::flash('warning', 'Please login to make the report.');
                return redirect('/social-buzz/');
            }
        }
    }
    public function postSocialBuzzComments(Request $request) {
        if (Auth::check() == true) {
            $messages = ['required' => 'Write something in comment textbox', ];
            $validator = Validator::make($request->all(), ['comment' => 'required'], $messages);
            if ($validator->fails()) {
                $response = ['validation_error' => $validator->messages()->first() ];
                return Response::json($response);
            } else {
                try {
                    $SocialBuzzComments = new SocialBuzzComments();
                    $SocialBuzzComments->user_id = Auth::user()->id;
                    $SocialBuzzComments->post_id = $request['post_id'];
                    $SocialBuzzComments->post_comment = $request['comment'];
                    $SocialBuzzComments->posted_by = $request['post_id'];
                    $SocialBuzzComments->created_by = Auth::user()->id;
                    $SocialBuzzComments->updated_by = Auth::user()->id;
                
                    $SocialBuzzComments->save();
                    $insertedId = $SocialBuzzComments->id;
                    if (!empty($insertedId)) {
                        $response = ['success' => 'Posted successfully.'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Something went wrong.'];
                        return Response::json($response);
                    }
                }
                catch(ModelNotFoundException $err) {
                    $response = ['warning' => 'Somethingwent wrong.unable to add the comment at a moment.'];
                    return Response::json($response);
                }
            }
        } else {
            Session::flash('warning', 'Please login to make the comment.');
            return redirect('/social-buzz/' . $request['category_id']);
        }
    }

    public function addCommercialAdviews(Request $request) {
        if(!empty(Auth::check())){
            if($request->ajax()){
                $whereCondition = ['ad_id' => $request['ad_id'], 'user_id' => Auth::user()->id];
                $checkAlreadyClicked = CommercialAdViews::where($whereCondition)->first();
                if(empty($checkAlreadyClicked)){
                    $currentSellerPlan = SellerPlans::where('user_id', '=', Auth::user()->id)->first();
                    $adViewsArray = [ 'seller_plan_id' => $currentSellerPlan['id'], 'plan_id' => $currentSellerPlan['plan_id'] , 'ad_id' => $request['ad_id'], 'user_id' => Auth::user()->id];
                    $addAdsViews = CommercialAdViews::insert($adViewsArray);
                    if($addAdsViews){
                        $response = ['success' => 'Ad view added successfully.'];
                        return Response::json($response);
                    } else {
                        $response = ['error' => 'Somethingwent wrong.unazble to add the comment at a moment..'];
                        return Response::json($response);
                    }
                }
            }
        } else {
            Session::flash('info', 'You must be login first.');
            return redirect('/');
        }
    }

    public function checkProductLink(Request $request) {
      if(!empty(Auth::check())) {
           if($request->ajax()){
              $talent_id = $request['talent_id'];
              $checkTalent = Talents::find($talent_id);
              if(!empty($checkTalent)) {
                    $response = ['success' => 'Valid product link.'];
                    return Response::json($response);
              } else {
                    $response = ['error' => 'Invalid product link.'];
                    return Response::json($response);
              }
           }
      } else {
         Session::flash('info', 'You must be login first.');
         return redirect('/');
      }
    }


}
