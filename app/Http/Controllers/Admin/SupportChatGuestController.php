<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupportChatGuest;
use App\Models\SupportChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\GuestUser;
use App\User;
use App\UsersRoles;
use Session;
use Route;
use Response;
use Carbon\Carbon;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Traits\MailsendTrait;
use Illuminate\Support\Facades\File;

class SupportChatGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = array();
      $admin_id = Auth::user()->id;

      $sortedSenderUser= DB::table('guest_users')
            ->join('support_chat_guests', 'guest_users.id', '=', 'support_chat_guests.sender_id', 'left outer')
            ->select(DB::raw('sum(support_chat_guests.read) as total_read'),
                DB::raw('count(support_chat_guests.id) as total_support_chat'),
                'guest_users.id', 'guest_users.username', 'guest_users.session_id',DB::raw('max(support_chat_guests.created_at) as created_at'))
            ->where('support_chat_guests.receiver_id', Auth::user()->id)
            ->where('guest_users.id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->groupBy('guest_users.id')
            ->get()->toArray();



        $sortedReceiverUser = DB::table('guest_users')
            ->join('support_chat_guests', 'guest_users.id', '=', 'support_chat_guests.receiver_id', 'left outer')
            ->select('guest_users.id', 'guest_users.username', 'guest_users.session_id',DB::raw('max(support_chat_guests.created_at) as created_at'))
            ->where('support_chat_guests.sender_id', Auth::user()->id)
            ->where('guest_users.id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->groupBy('guest_users.id')
            ->get()->toArray();

        $totalSorted = array_merge($sortedSenderUser, $sortedReceiverUser);



        usort($totalSorted, function($a, $b) {
            return $a->created_at < $b->created_at;
        });



        $uniqueSorted = [];
        foreach($totalSorted as $row){
            if(!array_key_exists($row->id,$uniqueSorted))
                $uniqueSorted[$row->id] = $row;
        }

        $existingId = array();
        foreach($uniqueSorted as $sender){
            $existingId[] = $sender->id;
        }



        $data['sorted_user'] = (object) $uniqueSorted;



        if($data['sorted_user'] && !empty($data['sorted_user']) && count((array)$data['sorted_user']) > 0 ){
            $data['active_message'] = SupportChatGuest::where('sender_id', reset($data['sorted_user'])->id)
                ->where('receiver_id', Auth::user()->id)
                ->orWhere(function($query) use ($data)
                {
                    $query->where('sender_id', Auth::user()->id)
                        ->where('receiver_id', reset($data['sorted_user'])->id);
                })
                ->orderBy('id', 'desc')
                ->take(30)->get()->toArray();

          $active_chat_user = array_key_first($uniqueSorted);

          $user = GuestUser::find($active_chat_user);

          if(count($data['active_message']) > 0){
          usort($data['active_message'], function ($a, $b) {
              return $a['created_at'] > $b['created_at'];
          });
          }
          $totalSorted = $data['active_message'];

          SupportChatGuest::where('receiver_id', $admin_id)->where('sender_id', $user->id)
            ->update(['read' => 1]);


        }else {
          $totalSorted = array();
        }


      return view('admin.chat_support.guest', compact('totalSorted','user','data'));

    }

    public function initGuestFront(Request $request)
    {

      if (Auth::check()) {

        Session::put('chat_session_id', Session::getId());
        Session::put('chat_type', 'registered');
        Session::put('guest_user_id', Auth::user()->id);
        Session::put('guest_user_name', Auth::user()->username);


        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;

        $message = new SupportChat();
        $message->created_by = $sender_id;
        $message->updated_by = $sender_id;
        $message->sender_id = $sender_id;
        $message->receiver_id = $receiver_id;
        $message->message = $request->message;
        $message->read = 0;
        $status = $message->save();

         if($status){
           Session::put('chat_init_id',$message->id);
           Session::put('chat_init_time',$message->created_at);
           Session::put('chat_replied', 'no');
              $totalSorted = SupportChat::with(['adminUser','guestUser'])->where('id', $message->id)->get()->toArray();
             return response($totalSorted, 200);
         }else{
             return response("can't send message.", 400);
         }


      }else {

        $guest_user = new GuestUser();

        $guest_user->username = $request->username;
        $guest_user->session_id	 = Session::getId();
        $save = $guest_user->save();

        if($save){

          Session::put('chat_session_id', $guest_user->session_id);
          Session::put('chat_type', 'guest');
          Session::put('guest_user_id', $guest_user->id);
          Session::put('guest_user_name', $guest_user->username);

          $sender_id = $guest_user->id;
          $receiver_id = $request->receiver_id;

          $message = new SupportChatGuest();
          $message->created_by = $sender_id;
          $message->updated_by = $sender_id;
          $message->sender_id = $sender_id;
          $message->receiver_id = $receiver_id;
          $message->message = $request->message;
          $message->read = 0;
          $message->is_guest = 1;

          $status = $message->save();

           if($status){
             Session::put('chat_init_id',$message->id);
             Session::put('chat_init_time',$message->created_at);
             Session::put('chat_replied', 'no');
                $totalSorted = SupportChatGuest::with(['adminUser','guestUser'])->where('id', $message->id)->get()->toArray();
               return response($totalSorted, 200);
           }else{
               return response("can't send message.", 400);
           }


        }else {
          return response("Can't initialize chat.", 400);
        }

      }



    }

    public function store(Request $request)
    {
      if (Auth::check()) {
        $sender_id = Auth::user()->id;
        $is_guest = 0;
      }else {
        $sender_id = Session::get('guest_user_id');
        $is_guest = 1;
      }

      $receiver_id = $request->receiver_id;
      $message = new SupportChatGuest();

      if ($request->hasFile('support_attach')) {

              $assetFile = $request->file('support_attach');

              $destinationPath = 'uploads/support-message-media';
              if(!File::isDirectory($destinationPath)){
                  File::makeDirectory($destinationPath, 0777, true, true);
              }
              $fileOriginalName = "chat_file_".time()."_".rand(0000000, 9999999) . $assetFile->getClientOriginalName();


              $uploadFile = $assetFile->move($destinationPath, $fileOriginalName);
              $message->message_media = $destinationPath ."/" .$fileOriginalName;
      }
      
      $message->created_by = $sender_id;
      $message->updated_by = $sender_id;
      $message->sender_id = $sender_id;
      $message->receiver_id = $receiver_id;
      $message->message = $request->message;
      $message->is_guest = $is_guest;
      $message->read = 0;

      $status = $message->save();

       if($status){
         $totalSorted = SupportChatGuest::with(['adminUser','guestUser'])->where('id', $message->id)->get()->toArray();
        return response($totalSorted, 200);
       }else{
           return response(null, 400);
       }
    }
    public function storeUser(Request $request)
    {

      $sender_id = Auth::user()->id;
      $message = new SupportChat();
      if ($request->hasFile('support_attach')) {

              $assetFile = $request->file('support_attach');

              $destinationPath = 'uploads/support-message-media';
              if(!File::isDirectory($destinationPath)){
                  File::makeDirectory($destinationPath, 0777, true, true);
              }
              $fileOriginalName = "chat_file_".time()."_".rand(0000000, 9999999) . $assetFile->getClientOriginalName();


              $uploadFile = $assetFile->move($destinationPath, $fileOriginalName);
              $message->message_media = $destinationPath ."/" .$fileOriginalName;
      }

      $receiver_id = $request->receiver_id;

      $message->created_by = $sender_id;
      $message->updated_by = $sender_id;
      $message->sender_id = $sender_id;
      $message->receiver_id = $receiver_id;
      $message->message = $request->message;
      $message->read = 0;

      $status = $message->save();

       if($status){
         $totalSorted = SupportChat::with(['adminUser','guestUser'])->where('id', $message->id)->get()->toArray();
        return response($totalSorted, 200);
       }else{
           return response(null, 400);
       }
    }

    public static function frontIndexGuest()
    {



      if (Auth::check() && Auth::user()->role_id != 1) {

        $sender_id = Auth::user()->id;
        $admin_id = env('SUPPORT_USER_ID');


        $totalSorted = SupportChat::with(['adminUser','guestUser'])->where('sender_id', $admin_id)
            ->where('receiver_id', $sender_id)
            ->orWhere(function($query) use ($admin_id,$sender_id)
            {
                $query->where('sender_id', $sender_id)
                    ->where('receiver_id', $admin_id);
            })
            ->orderBy('id', 'desc')
            ->take(30)->get()->toArray();
        SupportChat::where('receiver_id', $sender_id)->where('sender_id', $admin_id)
            ->update(['read' => 1]);


      }else {

        $sender_id = Session::get('guest_user_id');
        $admin_id = env('SUPPORT_USER_ID');

        $totalSorted = SupportChatGuest::with(['adminUser','guestUser'])->where('sender_id', $admin_id)
            ->where('receiver_id', $sender_id)
            ->orWhere(function($query) use ($admin_id,$sender_id)
            {
                $query->where('sender_id', $sender_id)
                    ->where('receiver_id', $admin_id);
            })
            ->orderBy('id', 'desc')
            ->take(30)->get()->toArray();
        SupportChatGuest::where('receiver_id', $sender_id)->where('sender_id', $admin_id)
            ->update(['read' => 1]);

      }


      if(count($totalSorted) > 0){

      usort($totalSorted, function ($a, $b) {
          return $a['created_at'] > $b['created_at'];
      });



      }

      if(count($totalSorted) > 0){
        return $totalSorted;
      }else {
        return array();
      }

    }

    public function getUnreadMessages($receiver_id,$sender_id)
    {

      $data = array();

      $receivedMessages = SupportChatGuest::where('receiver_id', $receiver_id)
          ->where('sender_id', $sender_id)
          ->where('read', 0)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();

      $data['received_messages'] = $receivedMessages;


      SupportChatGuest::where('receiver_id', $receiver_id)->where('sender_id', $sender_id)
          ->update(['read' => 1]);


          $sortedSenderUser= DB::table('guest_users')
                ->join('support_chat_guests', 'guest_users.id', '=', 'support_chat_guests.sender_id', 'left outer')
                ->select(DB::raw('sum(support_chat_guests.read) as total_read'),
                    DB::raw('count(support_chat_guests.id) as total_support_chats'),
                    'guest_users.id', 'guest_users.username', 'guest_users.session_id',DB::raw('max(support_chat_guests.created_at) as created_at'))
                ->where('support_chat_guests.receiver_id', Auth::user()->id)
                ->where('guest_users.id', '!=', Auth::user()->id)
                ->orderBy('created_at', 'DESC')
                ->groupBy('guest_users.id')
                ->get()->toArray();



            $sortedReceiverUser = DB::table('guest_users')
                ->join('support_chat_guests', 'guest_users.id', '=', 'support_chat_guests.receiver_id', 'left outer')
                ->select('guest_users.id', 'guest_users.username', 'guest_users.session_id',DB::raw('max(support_chat_guests.created_at) as created_at'))
                ->where('support_chat_guests.sender_id', Auth::user()->id)
                ->where('guest_users.id', '!=', Auth::user()->id)
                ->orderBy('created_at', 'DESC')
                ->groupBy('guest_users.id')
                ->get()->toArray();

            $totalSorted = array_merge($sortedSenderUser, $sortedReceiverUser);



            usort($totalSorted, function($a, $b) {
                return $a->created_at < $b->created_at;
            });





            $uniqueSorted = [];
            foreach($totalSorted as $row){
                if(!array_key_exists("u_".$row->id,$uniqueSorted))
                    $uniqueSorted["u_".$row->id] = $row;
            }

            foreach($uniqueSorted as $sender){
                if(isset($sender->total_read)){
                  $sender->unread_messages = $sender->total_support_chats - $sender->total_read;
                }else {
                  $sender->unread_messages = 0;
                }
            }


            $data['sorted_user'] = $uniqueSorted;
            return response($data, 200);
    }
    public function getUnreadMessagesGuest($sender_id)
    {

      $data = array();

      $receivedMessages = SupportChatGuest::with(['adminUser','guestUser'])->where('receiver_id', Session::get('guest_user_id'))
          ->where('sender_id', $sender_id)
          ->where('read', 0)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();


      SupportChatGuest::where('receiver_id', Session::get('guest_user_id'))->where('sender_id', $sender_id)
          ->update(['read' => 1]);

          if(count($receivedMessages) > 0 && session()->get('chat_replied') == 'no'){
            session()->put('chat_replied','yes');
            session()->save();
          }
          if(session()->get('chat_replied') == 'no'){
            $chat_init_time = Session::get('chat_init_time');
            $minutes = (time() - strtotime($chat_init_time)) / 60;

            if($minutes > 2){

              $message_txt = "Thank you for reaching out to FutureStarr. Please email your inquiries to <a style='color:blue;text-decoration:underline' href='mailto:custserv@futurestarr.com'>custserv@futurestarr.com</a>. We will respond within 24 hours. Have a Great Day!";
              $message = new SupportChatGuest();
              $message->created_by = $sender_id;
              $message->updated_by = $sender_id;
              $message->sender_id = $sender_id;
              $message->receiver_id = Session::get('guest_user_id');
              $message->message = $message_txt;
              $message->is_guest = 0;
              $message->read = 0;
              $status = $message->save();

              session()->put('chat_replied','yes');
              session()->save();
            }
          }
      return response($receivedMessages, 200);
    }
    public function getUnreadMessagesUser($sender_id)
    {

      $data = array();

      $receivedMessages = SupportChat::with(['adminUser','guestUser'])->where('receiver_id', Auth::user()->id)
          ->where('sender_id', $sender_id)
          ->where('read', 0)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();

      SupportChat::where('receiver_id', Auth::user()->id)->where('sender_id', $sender_id)
          ->update(['read' => 1]);

          if(count($receivedMessages) > 0 && session()->get('chat_replied') == 'no'){
            session()->put('chat_replied','yes');
            session()->save();
          }
          if(session()->get('chat_replied') == 'no'){
            $chat_init_time = Session::get('chat_init_time');
            $minutes = (time() - strtotime($chat_init_time)) / 60;

            if($minutes > 2){

              $message_txt = "Thank you for reaching out to FutureStarr. Please email your inquiries to <a style='color:blue;text-decoration:underline' href='mailto:custserv@futurestarr.com'>custserv@futurestarr.com</a>. We will respond within 24 hours. Have a Great Day!";
              $message = new SupportChat();
              $message->created_by = $sender_id;
              $message->updated_by = $sender_id;
              $message->sender_id = $sender_id;
              $message->receiver_id = Auth::user()->id;
              $message->message = $message_txt;
              $message->read = 0;
              $status = $message->save();

              session()->put('chat_replied','yes');
              session()->save();
            }
          }

      return response($receivedMessages, 200);
    }
    public function getChatMessages($receiver_id,$sender_id)
    {


      $totalSorted = SupportChatGuest::where('sender_id', $sender_id)
          ->where('receiver_id', Auth::user()->id)
          ->orWhere(function($query) use ($sender_id)
          {
              $query->where('sender_id', Auth::user()->id)
                  ->where('receiver_id', $sender_id);
          })
          ->orderBy('id', 'desc')
          ->take(30)->get()->toArray();


      if(count($totalSorted) > 0){

      usort($totalSorted, function ($a, $b) {
          return $a['created_at'] > $b['created_at'];
      });

      SupportChatGuest::where('receiver_id', $receiver_id)->where('sender_id', $sender_id)
          ->update(['read' => 1]);

      }

      if(count($totalSorted) > 0){
        return response($totalSorted, 200);
      }else {
        return response(0, 200);
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



}
