<?php
namespace App\Http\Controllers\Admin;

use App\Models\SupportChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
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

class SupportChatController extends Controller
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
      $sortedSenderUser= DB::table('users')
            ->join('support_chats', 'users.id', '=', 'support_chats.sender_id', 'left outer')
            ->select(DB::raw('sum(support_chats.read) as total_read'),
                DB::raw('count(support_chats.id) as total_support_chats'),
                'users.id', 'users.username', 'users.first_name', 'users.last_name',DB::raw('max(support_chats.created_at) as created_at'))
            ->where('support_chats.receiver_id', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->groupBy('users.id')
            ->get()->toArray();



        $sortedReceiverUser = DB::table('users')
            ->join('support_chats', 'users.id', '=', 'support_chats.receiver_id', 'left outer')
            ->select('users.id', 'users.username', 'users.first_name', 'users.last_name',DB::raw('max(support_chats.created_at) as created_at'))
            ->where('support_chats.sender_id', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->groupBy('users.id')
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
            $data['active_message'] = SupportChat::with('User')->where('sender_id', reset($data['sorted_user'])->id)
                ->where('receiver_id', Auth::user()->id)
                ->orWhere(function($query) use ($data)
                {
                    $query->where('sender_id', Auth::user()->id)
                        ->where('receiver_id', reset($data['sorted_user'])->id);
                })
                ->orderBy('id', 'desc')
                ->take(30)->get()->toArray();

          $active_chat_user = array_key_first($uniqueSorted);

          $user = User::find($active_chat_user);

          SupportChat::where('receiver_id', $admin_id)->where('sender_id', $user->id)
              ->update(['read' => 1]);

          $totalSorted = array_merge($data['active_message'], array());


          if(count($data['active_message']) > 0){
          usort($data['active_message'], function ($a, $b) {
              return $a['created_at'] > $b['created_at'];
          });
          }
          $totalSorted = $data['active_message'];

          return view('admin.chat_support.index', compact('totalSorted','user','data'));

        }
        

        return view('admin.chat_support.index', compact('totalSorted','data'));
      }

    public function frontIndex()
    {

      $sender_id = Auth::user()->id;
      $receiver_id = 3336;



      $chat_list = SupportChat::where('receiver_id', $sender_id)->where('sender_id', $receiver_id)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();



      //SupportChat::where('receiver_id', $sender_id)->where('sender_id', $receiver_id)
          //->update(['read' => 1]);

      $receivedMessages = SupportChat::where('receiver_id', $sender_id)->where('sender_id', $receiver_id)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();

      $sendMessages = SupportChat::where('sender_id', $sender_id)->where('receiver_id', $receiver_id)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();

      $user = User::find($receiver_id);




      $totalSorted = array_merge((array)$sendMessages, (array)$receivedMessages);


      if(count($totalSorted) > 0){
      usort($totalSorted, function ($a, $b) {
          return $a->created_at > $b->created_at;
      });
      $uniqueSorted = [];
      }

      return view('frontend.chat_support.index', compact('totalSorted','user'));
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

      $sender_id = Auth::user()->id;
      $receiver_id = $request->receiver_id;

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
      $message->created_by = $sender_id;
      $message->updated_by = $sender_id;
      $message->sender_id = $sender_id;
      $message->receiver_id = $receiver_id;
      $message->message = $request->message;
      $message->read = 0;

      $status = $message->save();

       if($status){
           return response($message, 200);
       }else{
           return response(null, 400);
       }

    }

    public function getUnreadMessages($receiver_id,$sender_id)
    {

      $data = array();

      $receivedMessages = SupportChat::where('receiver_id', $receiver_id)
          ->where('sender_id', $sender_id)
          ->where('read', 0)
          ->orderBy('created_at', 'ASC')
          ->get()
          ->all();

      $data['received_messages'] = $receivedMessages;


      SupportChat::where('receiver_id', $receiver_id)->where('sender_id', $sender_id)
          ->update(['read' => 1]);


      $sortedSenderUser= DB::table('users')
            ->join('support_chats', 'users.id', '=', 'support_chats.sender_id', 'left outer')
            ->select(DB::raw('sum(support_chats.read) as total_read'),
                DB::raw('count(support_chats.id) as total_support_chats'),
                'users.id', 'users.username', 'users.first_name', 'users.last_name',DB::raw('max(support_chats.created_at) as created_at'))
            ->where('support_chats.receiver_id', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->groupBy('users.id')
            ->get()->toArray();



        $sortedReceiverUser = DB::table('users')
            ->join('support_chats', 'users.id', '=', 'support_chats.receiver_id', 'left outer')
            ->select('users.id', 'users.username', 'users.first_name', 'users.last_name',DB::raw('max(support_chats.created_at) as created_at'))
            ->where('support_chats.sender_id', Auth::user()->id)
            ->where('users.id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'DESC')
            ->groupBy('users.id')
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

        $existingId = array();
        foreach($uniqueSorted as $sender){
            if(isset($sender->total_read)){
              $sender->unread_messages = $sender->total_support_chats - $sender->total_read;
            }else {
              $sender->unread_messages = 0;
            }
        }



        $data['sorted_user'] = (object) $uniqueSorted;

      return response($data, 200);
    }
    public function getChatMessages($receiver_id,$sender_id)
    {


      $totalSorted = SupportChat::with('User')->where('sender_id', $sender_id)
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

      SupportChat::where('receiver_id', $receiver_id)->where('sender_id', $sender_id)
          ->update(['read' => 1]);

      }

      if(count($totalSorted) > 0){
        return response($totalSorted, 200);
      }else {
        return response(0, 200);
      }



    }

}
