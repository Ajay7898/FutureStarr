<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FavrioteUser;
use App\Models\Fanbase;
use App\User;
use App\Models\Chats;
use App\Traits\MailsendTrait;
use Response;
use Auth;

class FavouriteUserController extends Controller
{
    use MailsendTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id ='')
    {
        if ($request->ajax() && !empty($id)) {
             
            $where_condition = ['user_id' => Auth::user()->id, 'fav_user_id' => $request->fav_user_id];
                  
                 $where = ['follower' => $id, 'following' => Auth::user()->id];
                 if($request->type =='remove') {
                      $table_array = ['is_fav' => '0'];
                      $message = 'Removed from super star list.';
                 } else {
                    $table_array = ['is_fav' => '1'];
                    $message = 'Added as super user.';
                 }
                 
                 $added = Fanbase::where($where)->update($table_array);

                 if(!empty($added)) {
                       $response = ['success' => $message];
                       return Response::json($response);
                 } else {
                       $response = ['error' => 'Unable to process the request.'];
                       return Response::json($response);
                 }

        } else {
             $response = ['error' => 'Invalid request.'];
             return Response::json($response);
        }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send_notification(Request $request)
    {
        if ($request->ajax() && !empty($request->all())) {

            $user = User::where('email', $request->email)->first();

            $chat = array(
                "sent_by" => $user['id'],
                "received_by" => Auth::user()->id,
                "last_message_sender" => $user['id'],
                "last_message" => $request->message
            );

            Chats::insert($chat);

            $message = [];
            $name = $user['first_name'].' '.$user['last_name'];
            $sender = Auth::user()->first_name.' '.Auth::user()->last_name;
            $message = ['sender'=> $sender, 'name' => $name, 'email' => $request->email, 'message' => $request->message];
            $sendOrfail = $this->sendChatMessageNotification($message);
            
            if(empty($sendOrfail)) {
                 $response = ['error' => 'Email not sent.'];
                 return Response::json($response);
            } else {
                 $response = ['success' => 'Email sent.'];
                 return Response::json($response);
            }
        } else {

             $response = ['error' => 'Invalid request.'];
             return Response::json($response);
        }
    }
}
