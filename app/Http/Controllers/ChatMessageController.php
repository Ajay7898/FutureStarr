<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\ChatMessage;
use Auth;
use DB;
use Cache;
use Carbon\Carbon;

class ChatMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function chat($id){
        $this->id = $id;
        $receiver = User::where('id', $this->id)->first(); 

        $messages = ChatMessage::where('sent_by', Auth::id())
            ->where('received_by', $this->id)
            ->where('deleted_sent_by', NULL)            
            ->orWhere(function ($query) {
                $query->where('sent_by', $this->id)
                    ->where('received_by', Auth::id())
                    ->where('deleted_received_by', NULL);                       
            })
            ->orderBy('created_at', 'desc')
            // ->take(40)
            ->get()->reverse();
        // return $messages;
        if ($messages->isNotEmpty()) {
            DB::table('chat_messages')->where('sent_by', $this->id)
            ->where('received_by', Auth::id())->update([
                'read_flag' => 1
            ]);

            $data['html'] = view('frontend.chat-message.chat-message-render', compact('receiver', 'messages'))->render();
            $data['receiver_id'] = $receiver->id;
            $data['lmi'] = $messages[0]->id;
            return $data;
        }
    }

    public function refreshMessage($lmi, $rec){
        $this->receiver_id = $rec;
        $receiver = User::where('id', $this->receiver_id)->first();
        $messages = ChatMessage::where('id', '>', $lmi)
            ->where(function ($query) {
                $query->where('sent_by', Auth::id())
                    ->where('received_by', $this->receiver_id)
                    ->where('deleted_sent_by', NULL) 
                    ->orWhere(function ($add) {
                        $add->where('sent_by', $this->receiver_id)
                            ->where('received_by', Auth::id())  
                            ->where('deleted_received_by', NULL);                   
                    });                     
            })
            ->orderBy('created_at', 'desc')
            ->get()->reverse();
        // return $messages;
        if ($messages->isNotEmpty()) {

            DB::table('chat_messages')->where('sent_by', $this->receiver_id)
            ->where('received_by', Auth::id())->update([
                'read_flag' => 1
            ]);

            $data['html'] = view('frontend.chat-message.chat-message-refresh-render', compact('messages', 'receiver'))->render();
            $data['receiver_id'] = $receiver->id;
            $data['lmi'] = $messages[0]['id'];
            return $data;
        }       
    }

    public function sendMessage(Request $request){
        // return $request->all();
        $mess = new ChatMessage;
        $mess->sent_by = Auth::id();
        $mess->received_by = $request->received_by;
        $mess->message = $request->message;

        $message_file = $request->file('message_file');
        if ($message_file) {
            $fileName = $message_file->getClientOriginalName();
            $fileName1 = Auth::id() . '-' . date("YmdHis") . str_replace(" ", "-", $fileName);
            $pathName = 'uploads/message-media/' . $fileName1;
            //$path = storage_path();
            $path = public_path();
            $message_file->move($path . '/uploads/message-media/', $fileName1);
            $mess->message_media = $pathName;
        }
        
        $mess->save();

        $mess->profile_pic = Auth::user()->profile_pic;


        if ($mess) {
            $data['html'] = view('frontend.chat-message.chat-message-send-render', compact('mess'))->render();
            $data['lmi'] = $mess['id'];
            return $data;
        } 

    }


    public function getInboxMessage($cond){
        $messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
            ->select('chat_messages.*', 'users.id as user_id','users.username', 'users.profile_pic', DB::raw('COUNT(chat_messages.sent_by) as message_count'))
            ->where('chat_messages.received_by', Auth::id())
            ->where('chat_messages.deleted_received_by', NULL)
            ->where('chat_messages.read_flag', 0)
            ->orderBy('chat_messages.created_at', 'desc');
            // ->take(40)

        $data['count'] = $messages->count();

        $messages->groupBy('chat_messages.sent_by');

        $data['messages'] = $messages->get();


        if ($data['messages']->isNotEmpty()) {
            $data['messages'] = view('frontend.chat-message.chat-inbox-render', compact('data', 'cond'))->render();
            return $data;
        }
        return response()->json(['state' => false]);
        
    }


    public function deleteInboxMessage($id){

        $deleted_sent_msg = ChatMessage::where('id', $id)
            ->where('sent_by', Auth::id())->first();
        if ($deleted_sent_msg) {
            $deleted_sent_msg->deleted_sent_by = date('Y-m-d H:i:s');
            $deleted_sent_msg->update();
            return $deleted_sent_msg;
        }
        $deleted_received_msg = ChatMessage::where('id', $id)
            ->where('received_by', Auth::id())->first();
        if ($deleted_received_msg) {
            $deleted_received_msg->deleted_received_by = date('Y-m-d H:i:s');
            $deleted_received_msg->update();
            return $deleted_received_msg;
        }

    }

    public function checkDeleteInboxMessage(Request $request){

        foreach ($request->sid as $key => $id) {
            $deleted_sent_msg = ChatMessage::where('received_by', $id)
                ->where('sent_by', Auth::id())->update([
                    'deleted_sent_by' => date('Y-m-d H:i:s')
                ]);

            $deleted_received_msg = ChatMessage::where('sent_by', $id)
                ->where('received_by', Auth::id())->update([
                    'deleted_received_by' => date('Y-m-d H:i:s')
                ]);
        }

    }


    public function getAllUser(){
        $messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
            ->select('chat_messages.*', 'users.username', 'users.profile_pic', 'users.role_id', 'users.public_profile')
            ->where('chat_messages.received_by', Auth::id())
            ->where('chat_messages.deleted_received_by', NULL)
            // ->orWhere(function ($query) {
            //     $query->where('chat_messages.received_by', Auth::id())
            //         ->where('chat_messages.deleted_received_by', NULL);                       
            // })
            ->orderBy('chat_messages.created_at', 'desc')
            // ->take(40)
            // ->groupBy('chat_messages.sent_by');
            ->get();

        if ($messages->isNotEmpty()) {
            return view('frontend.chat-message.chat-message-user-render', compact('messages'))->render();
        }
    }


    public function getAllReadMsg(){
        $messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
            ->select('chat_messages.*', 'users.username', 'users.profile_pic', 'users.role_id', 'users.public_profile')
            ->where('chat_messages.received_by', Auth::id())
            ->where('chat_messages.read_flag', 1)
            ->where('chat_messages.deleted_received_by', NULL)
            ->orderBy('chat_messages.created_at', 'desc')
            // ->take(40)
            // ->groupBy('chat_messages.sent_by');
            ->get();

        if ($messages->isNotEmpty()) {
            return view('frontend.chat-message.chat-message-user-render', compact('messages'))->render();
        }
    }


    public function getAllUnreadMsg(){
        $messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
            ->select('chat_messages.*', 'users.username', 'users.profile_pic', 'users.role_id', 'users.public_profile')
            ->where('chat_messages.received_by', Auth::id())
            ->where('chat_messages.read_flag', 0)
            ->where('chat_messages.deleted_received_by', NULL)
            ->orderBy('chat_messages.created_at', 'desc')
            // ->take(40)
            // ->groupBy('chat_messages.sent_by');
            ->get();

        if ($messages->isNotEmpty()) {
            return view('frontend.chat-message.chat-message-user-render', compact('messages'))->render();
        }

        return response()->json(['state' => false]);
    }


    public function sendAutoMessage(){
        $users = User::where('auto_reply', 1)->select('id', 'automatic_message')->get();
        // return $users;
        // $all_message = [];
        foreach ($users as $key => $user) {
            $message = ChatMessage::where('received_by', $user->id)->latest()->first();  

            if ($message->auto_reply == NULL && $message->read_flag == 0 && Carbon::parse($message->created_at)->addHours(24) <= Carbon::now()) {
                // $all_message[] = $message;

                $chat = ChatMessage::where('id', $message->id)->first();
                $chat->auto_reply = 1;
                $chat->save();

                $chat = new ChatMessage;
                $chat->message = $user->automatic_message;
                $chat->sent_by = $message->received_by;
                $chat->received_by = $message->sent_by;
                $chat->auto_reply = 1;
                $chat->save();

                // $all_message[] = $message;
            }          
        }

        // return $all_message;
    }
}
