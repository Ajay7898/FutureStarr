<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Fanbase;
use App\Models\SocialBuzzRiders;
use App\Models\TalentRiders;
use App\User;
use App\Message;
use App\Models\Talents;
use App\Models\Chats;
use App\Models\PublicProfileMessage;
use App\Models\ProfileVisitor;
use App\Models\ChatMessage;
use App\Traits\MailsendTrait;
use Session;
use Response;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\TalentCatagory;
use App\Models\SocialBuzz;
use App\Models\SocialBuzzComments;
use App\Models\SocialBuzzReplies;
use App\Models\SocialBuzzAwards;
use App\Models\CommercialAds;
use App\Models\Metatags;
use Helpers\Customhelper;
use App\Models\CommercialAdViews;
use App\Models\SellerPlans;


class PublicProfileController extends Controller
{  
     use MailsendTrait;

    /**
     * Display a buyer public profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = '', Request $request) 
    {
      
       if(!empty($id) && is_string($id)) {
            
             $user = [];
             $riders = [];
             $following = [];
             $self_rider = [];

             $user  = User::where('public_profile', $id)->first();

             if(empty($user) || $user['role_id'] != '3') {
                   Session::flash('error', 'Page you are looking for does not exist.');
                   return redirect('/home', 301); 
             }
            
             $riders = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile',  'users_roles.name as role')
                ->where('following', $user['id'])
                ->get();
             
             $ride_where = ['following' => $user['id'], 'follower' => !empty(Auth::user()->id) ? Auth::user()->id : '' ];
             $self_rider = Fanbase::where($ride_where)->first();
             $following = Fanbase::where('follower', $user['id'])->count();

             $profile_views = ProfileVisitor::where(['profile_id' => $user['id'] ])->count();
			 
			 
             /************* TALENT CATEGORIES **************/
             
             $talentCategories = TalentCatagory::all();

             /************* SOCIAL BUZZ ******************/

             $metaTags = [];
             $metaTags  = ['title' => $user['username'], 'description' => $user['description'], 'keywords' => $user['username']];

             $check = Auth::check();
             $whereCondition = ['user_id' => $user['id'], 'active' => 1];
             $socialBuzzList = SocialBuzz::with('getUserData', 'getTalentCatagories', 'getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'alreadyAwarded', 'selfRider')->where($whereCondition)->orderBy('id', 'DESC')->get();
 
         
            return view('frontend.public-profile.buyer', compact ('user', 'following', 'riders', 'self_rider', 'profile_views', 'check', 'talentCategories', 'socialBuzzList', 'metaTags'));

        } else {

                session::flash('error', 'Page you are looking for not exist');
                return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '', Request $request)
    { 

        if(!empty($id) && is_string($id)) {
                
             $user    = [];
             $riders  = [];
             $following = [];
             $talents   = [];
             $talentCategories = [];
             $self_rider = [];
             $socialBuzz = [];

             $user  = User::where('public_profile', $id)->first();
             if(empty($user) || $user['role_id'] != '4') {
                   Session::flash('error', 'Page you are looking for does not exist.');
                   return redirect( route('home') );
             }
            
             $riders = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('following', $user['id'])
                ->get();
             
             $ride_where = ['following' => $user['id'], 'follower' => !empty(Auth::user()->id) ? Auth::user()->id : '' ];
             $self_rider = Fanbase::where($ride_where)->first();
             $following = Fanbase::where('follower', $user['id'])->count();
             $profile_views = ProfileVisitor::where(['profile_id' => $user['id'] ])->count();
             
             /************* SIMILAR TALENTS ******************/
             $talent_where = ['user_id' => $user['id'], 'approved' => 1];
             $talents = Talents::with(['commercialMedia'])->where($talent_where)->get();

             /************* TALENT CATEGORIES **************/
             $talentCategories = TalentCatagory::all();

             /************* SOCIAL BUZZ ******************/
              $metaTags = [];
              $metaTags  = ['title' => $user['username'], 'description' => $user['description'], 'keywords' => $user['username']];
             
             $check = Auth::check();
             $whereCondition = ['user_id' => $user['id'], 'active' => 1];
             $socialBuzzList = SocialBuzz::with('getUserData', 'getTalentCatagories', 'getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'alreadyAwarded', 'selfRider')->where($whereCondition)->orderBy('id', 'DESC')->get();

             //dd($socialBuzzList);
             return view('frontend.public-profile.seller', compact ('user', 'following', 'riders', 'talents', 'self_rider', 'profile_views', 'check', 'talentCategories', 'socialBuzzList', 'metaTags'));
             
        }  else {

                session::flash('error', 'Page you are looking for not exist');
                return redirect('/');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_old(Request $request)
    {
        if(!empty(Auth::check())) {
             
             if($request->ajax()) {
                  
                  if($request->to == '' || $request->from == '' || $request->message == '') {
                      $response = ['required' => 'Message field is required'];
                      return Response::json($response);
                  }

                  $to = Crypt::decryptString($request->to) ;
                  $from = $request->from;
                  if($to == $from) {
                         $response = ['info' => 'Sending message to itself not possible.'];
                         return Response::json($response);
                  } else {
                         $table_array = ['message_to' => $to,'message_from' => $from, 'message' => strip_tags($request->message) ];
                         $message = PublicProfileMessage::create($table_array);
                         if(!empty($message)) {

                             $table_data = ['from_user' => $from, 'to_user' => $to, 'content' => $message];
                             $insert = DB::table('messages_live')->insert($table_data);
                             
                             $message_to = User::find($to);
                             $message_from = User::find($from);

                             $email['from'] = $message_from['email'];
                             $email['to'] = $message_to['email'];

                             $email['to_name'] = $message_to['first_name'].' '.$message_to['last_name'];
                             $email['from_name'] = $message_from['first_name'].' '.$message_from['last_name'];

                             $email['content'] = strip_tags($request->message);

                             $this->triggerMessageEmail($email);

                             $response = ['success' => 'Message sent successfully!'];
                             return Response::json($response);

                         } else {

                             $response = ['error' => 'Unable to process the request!'];
                             return Response::json($response);
                         }
                  }
             } else {
                Session::flash('error', 'No direct script access allowed.');
                return redirect(url()->previous());
             }
        } else {
            Session::flash('error', 'You must be login first.');
            return redirect(url()->previous());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty(Auth::check())) {
             
             if($request->ajax()) {
                  
                  if($request->to == '' || $request->from == '' || $request->message == '') {
                      $response = ['required' => 'Message field is required'];
                      return Response::json($response);
                  }

                  $to = Crypt::decryptString($request->to) ;
                  $from = $request->from;
                  if($to == $from) {
                         $response = ['info' => 'Sending message to itself not possible.'];
                         return Response::json($response);
                  } else {
                        $fanbase = ['following' => $to , 'follower' => $from ];
                        $if_fanbase = Fanbase::where($fanbase)->first();
                    if(!empty($if_fanbase["id"])){

                        $mess = new ChatMessage;
                        $mess->sent_by = $from;
                        $mess->received_by = $to;
                        $mess->message = strip_tags($request->message);       
                        $mess->save();
 
                    }
                    else{
                        $mess = new ChatMessage;
                        $mess->sent_by = $from;
                        $mess->received_by = $to;
                        $mess->message = strip_tags($request->message);       
                        $mess->save();
                    }
                    
                    $message_to = User::find($to);
                    $message_from = User::find($from);

                    $email['from'] = $message_from['email'];
                    $email['to'] = $message_to['email'];

                    $email['to_name'] = $message_to['first_name'].' '.$message_to['last_name'];
                    $email['from_name'] = $message_from['first_name'].' '.$message_from['last_name'];

                    $email['content'] = strip_tags($request->message);

                    $this->triggerMessageEmail($email);

                    $response = ['success' => 'Message sent successfully!'];
                    return Response::json($response);

                }
             } else {
                Session::flash('error', 'No direct script access allowed.');
                return redirect(url()->previous());
             }
        } else {
            Session::flash('error', 'You must be login first.');
            return redirect(url()->previous());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        if(!empty(Auth::check())) {
             
             if($request->ajax()) {
                  
                  if($request->to == '' || $request->from == '') {
                      $response = ['required' => 'something is wrong.Try again later.'];
                      return Response::json($response);
                  }

                  $to = Crypt::decryptString($request->to) ;
                  $from = $request->from;
                  if($to == $from) {
                         $response = ['info' => 'Add rider to itself not possible.'];
                         return Response::json($response);
                  } else {

                         $table_array = ['follower' => $from, 'following' => $to];

                         $message = Fanbase::create($table_array);
                         if(!empty($message)) {

                            $user = User::where('id', $to)->first();
                            $message = [];
                            $name = $user->first_name.' '.$user->last_name;
                            $sender = Auth::user()->first_name.' '.Auth::user()->last_name;
                            $message = ['sender'=> $sender, 'name' => $name, 'email' => $user->email, 'content' => ''];
                            $sendOrfail = $this->triggerRiderEmail($message);
                            
                             $response = ['success' => 'Rider added successfully!'];
                             return Response::json($response);

                         } else {

                             $response = ['error' => 'Unable to process the request!'];
                             return Response::json($response);
                         }
                  }
             } else {
                Session::flash('error', 'No direct script access allowed.');
                return redirect(url()->previous());
             }
        } else {
            Session::flash('error', 'You must be login first.');
            return redirect(url()->previous());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Function to unfollow the following user.
     * @param
     *
     */

     public function unfollowUser(Request $request, $following = '', $follower ='') {

           if(!empty($following) && !empty($following) && is_string($follower) && is_string($follower)) {

               $id  = Crypt::decryptString($following);
               $authid = Crypt::decryptString($follower);

               $where = ['following' => $id , 'follower' => $authid ];
               $unfollow = Fanbase::where($where)->delete();
               
               if(!empty($unfollow)) {

                    $soc_where = ['user_id' => $authid, 'social_buzz_by' => $id];
                    SocialBuzzRiders::where($soc_where)->delete();

                    $talent_where = ['user_id' => $authid, 'talent_by' => $id];
                    TalentRiders::where($talent_where)->delete();

                     $response = ['success' => 'unfollow successfully and removed from the list.'];
                     return Response::json($response);
               }

           } else {

               $response = ['error' => 'No direct script access allowed.'];
               return Response::json($response);
           }
     }

     /**
     * Function to visitor count to buyer and seller profile.
     * @param
     *
     */

     public function visitorProfile(Request $request) {
            
             if($request->ajax()) {
                 
                 $explode = explode('/', $request->pathname);
                 $profile = $explode[1];
                 $profile_id = Crypt::decryptString($explode[2]);
                 $where = ['visitor_ip' => $request->ip , 'profile_id' => $profile_id, 'profile' => $profile ];
                 
                 $checkExist = ProfileVisitor::where($where)->first();
                 if(empty($checkExist)) {
                       
                       $table_array = ['visitor_ip' => $request->ip , 
                                       'visitor_country' => $request->country , 
                                       'profile' => $profile, 
                                       'profile_id' => $profile_id 
                                   ];
                        $counted = ProfileVisitor::create($table_array);
                        if(!empty($counted)) {

                            $response = ['success' => 'visitor counted.'];
                            return Response::json($response);

                        } else {

                            $response = ['error' => 'error encounter.'];
                            return Response::json($response);
                        }
                 } else {
                       $response = ['success' => 'already counted.'];
                       return Response::json($response);
                 }
             } else {
                  $response = ['error' => 'Unable to process the request!'];
                  return Response::json($response);
             }
     }
}
