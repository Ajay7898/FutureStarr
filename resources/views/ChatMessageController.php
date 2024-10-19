<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\ChatMessage;
use Auth;
use DB;

class ChatMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // public function index(){
    // 	$users = User::whereNotIn('id', [ Auth::id() ])->get();
    // 	return view('pages.chat.user', compact('users'));
    // }

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

        $mess = new ChatMessage;
        $mess->sent_by = Auth::id();
        $mess->received_by = $request->received_by;
        $mess->message = $request->message;

        $message_file = $request->file('message_file');
        if ($message_file) {
            $fileName = $message_file->getClientOriginalName();
            $fileName1 = Auth::id() . '-' . date("YmdHis") . str_replace(" ", "-", $fileName);
            $pathName = ('uploads/message-media/' . $fileName1);
            //$path = storage_path();
            $path = public_path();
            $message_file->move($path . '/uploads/message-media/', $fileName1);
            $mess->message_media = $pathName;
        }
    	
    	$mess->save();

    	$mess->profile_pic = Auth::user()->profile_pic;


    	return $mess;

    	// return view('frontend.chat-message.single-chat-render', compact('mess'))->render();
    }


    public function getInboxMessage(){
    	$messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
    		->select('chat_messages.*', 'users.first_name', 'users.last_name', 'users.profile_pic', DB::raw('COUNT(chat_messages.sent_by) as message_count'))
    		->where('chat_messages.received_by', Auth::id())
    		->where('chat_messages.read_flag', 0)
	    	->orderBy('chat_messages.created_at', 'desc');
	    	// ->take(40)
        $data['count'] = $messages->count();

    	$messages->groupBy('chat_messages.sent_by');

    	$data['messages'] = $messages->get();

    	return $data;
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


    public function getAllUser(){
    	$messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
    		->select('chat_messages.*', 'users.first_name', 'users.last_name', 'users.profile_pic')
    		->where('chat_messages.sent_by', Auth::id())
            ->where('chat_messages.deleted_sent_by', NULL)
            ->orWhere(function ($query) {
                $query->where('chat_messages.received_by', Auth::id())
                    ->where('chat_messages.deleted_received_by', NULL);                       
            })
	    	->orderBy('chat_messages.created_at', 'desc')
	    	// ->take(40)
	    	// ->groupBy('chat_messages.sent_by');
	    	->get();


    	return $messages;
    }


    public function getAllReadMsg(){
    	$messages = ChatMessage::RightJoin('users', 'chat_messages.received_by', 'users.id')
    		->select('chat_messages.*', 'users.first_name', 'users.last_name', 'users.profile_pic')
    		->where('chat_messages.received_by', Auth::id())
    		->where('chat_messages.read_flag', 1)
	    	->orderBy('chat_messages.created_at', 'desc')
	    	// ->take(40)
	    	// ->groupBy('chat_messages.sent_by');
	    	->get();


    	return $messages;
    }


    public function getAllUnreadMsg(){
    	$messages = ChatMessage::RightJoin('users', 'chat_messages.received_by', 'users.id')
    		->select('chat_messages.*', 'users.first_name', 'users.last_name', 'users.profile_pic')
    		->where('chat_messages.received_by', Auth::id())
    		->where('chat_messages.read_flag', 0)
	    	->orderBy('chat_messages.created_at', 'desc')
	    	// ->take(40)
	    	// ->groupBy('chat_messages.sent_by');
	    	->get();


    	return $messages;
    }
}