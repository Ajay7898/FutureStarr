<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Chats;
use Illuminate\Http\Request;

class getallusercontroller extends Controller {
	public function __construct() {
		//Log::info("Sumit...");
		DB::enableQueryLog();
	}

	public function getAllUser_old($current_id) {

		/*
			 *  true query for check user unread msg.
			 *	SELECT u.id,u.first_name,u.last_name,m.sent_by,m.received_by,sum(case when m.read_flag = 0 then 1 else 0 end) as
			 *  read_count FROM messages m INNER JOIN users u ON m.sent_by = u.id GROUP BY m.sent_by
			 *
		*/
		$AllUsers = DB::table('messages')
			->select(array('users.id', 'users.first_name', 'users.last_name', 'messages.sent_by', 'messages.received_by', 'messages.date', 'messages.id as msgid', 'messages.message', DB::raw('sum(case when messages.read_flag = 0 then 1 else 0 end) as count_msg')))
		// ->join('users', 'messages.sent_by','=','users.id')
		// ->leftJoin('users', DB::raw('(messages.sent_by = users.id || messages.received_by = users.id)'))
		// ->leftJoin('users', function($join){
		// 	$join->on(DB::raw('(messages.sent_by=users.id || messages.received_by=users.id)'));
		// 			// ->on('messages.received_by', '=', 'users.id');
		// })
		// ->leftJoin('users', 'messages.sent_by=users.id || messages.received_by = users.id')
			->join("users", function ($join) {
				$join->on("messages.sent_by", "=", "users.id")
					->orWhere("messages.received_by", "=", "users.id");
			})
			->where('messages.received_by', '=', $current_id)
			->orWhere('messages.sent_by', '=', $current_id)
		// ->whereNotIn('users.id',array($current_id))
			->groupBy('messages.sent_by')
			->orderBy('messages.date', 'desc')
			->get();
		// print_r(DB::getQueryLog());die();
		// echo "<pre>";
		// print_r($AllUsers);die();
		return $AllUsers;
		// $allUserMessage = array();
		// foreach ($AllUsers as $user) {
		// 	// $us
		// }
	}

	public function msgRead($current_id,$sent_by) {
		$chat_is = ['id' => $sent_by];
		$chat = Chats::where($chat_is)->first();
		$sent_ = $chat['sent_by'];
		DB::table('chats')
			->where('sent_by', $sent_)
			->where('received_by', $current_id)
			->update(['msg_status' => 1]);
	}

	public function msgReadTwo($current_id,$sent_by) {
		DB::table('chats')
			->where('id', $sent_by)
			->where('msg_status', 0)
			->update(['msg_status' => 1]);
	}

	public function getAllUser($current_id, Request $request) {
		
		$AllUsers = DB::table('chats')
			->select("*")
			->where('sent_by', '=', $current_id)
			->orWhere('received_by', '=', $current_id)
			->orderBy('last_activity', 'desc')
			->get();

		$root = $request->root();
		$newPath = $root . '/public' . '/';

		foreach ($AllUsers as $user) {
			$user->count_msg = $this->getMessageCount($user->id, $current_id, '0');
			if ($user->sent_by != $current_id) {
				$userdata = $this->getUserProfile($user->sent_by);
			} else {
				$userdata = $this->getUserProfile($user->received_by);
			}
			if ($userdata) {
				$user->chat_id = $user->id;
				$user->message = $user->last_message;
				$user->date = $user->last_activity;
				$user->user_id = $userdata->user_id;
				$user->first_name = $userdata->first_name;
				$user->last_name = $userdata->last_name;
				if ($userdata->profile_pic) {
					$user->profile_pic = $userdata->profile_pic;
				} else {
					$user->profile_pic = "";
				}
			}

		}
		// print_r($AllUsers);die();
		return $AllUsers;
	}
	
	public function getInboxUser($current_id, Request $request) {
		 
		$AllUsers['Users'] = DB::table('chats AS ch')
			->select("*")
			->where('ch.received_by', '=', $current_id)	
			->where('ch.last_message_sender', '=', $current_id)	
			->whereIn('ch.last_activity',function($query) use ($current_id) {
				$query->select(DB::raw('max(last_activity)'))
				->from('chats AS c')
				->whereColumn('c.sent_by','ch.sent_by')
				->where('c.received_by','=',$current_id);
			})
			->get();

		$AllUsers['unread_msg_count'] = DB::table('chats')
		->select(DB::raw('COUNT(*) as c,sent_by'))
		->where('msg_status', '=', 0)
		->where('received_by', '=', $current_id)
		->groupBy('sent_by')
		->get();


		$root = $request->root();
		$newPath = $root . '/public' . '/';

		foreach ($AllUsers['Users'] as $user) {
			$user->count_msg = $this->getMessageCount($user->id, $current_id, '0');
			if ($user->sent_by != $current_id) {
				$userdata = $this->getUserProfile($user->sent_by);
			} else {
				$userdata = $this->getUserProfile($user->received_by);
			}
			if ($userdata) {
				$user->chat_id = $user->id;
				$user->message = $user->last_message;
				$user->date = $user->last_activity;
				$user->user_id = $userdata->user_id;
				$user->first_name = $userdata->first_name;
				$user->last_name = $userdata->last_name;
				if ($userdata->profile_pic) {
					$user->profile_pic = $userdata->profile_pic;
				} else {
					$user->profile_pic = "";
				}
			}

		}
		// print_r($AllUsers);die();
		return $AllUsers;
	}

	public function getUserProfile($userId) {
		$user = DB::table('users')
			->select(array("id AS user_id", "first_name", "last_name", "profile_pic"))
			->where('id', '=', $userId)
			->first();
		// print_r($user);die();
		return $user;
	}

	public function getPublicProfile($user_id, Request $request) {
		$response = array();
		$response['success'] = false;
		$response['message'] = '';
		$response['talents'] = false;

		$user = DB::table('users')
			->select(array("users.*", "roles.name as role"))
			->join('roles', 'users.role_id', '=', 'roles.id')
			->where('users.id', '=', $user_id)
			->first();
		// if($user->)
		$root = $request->root();
		if ($user) {
			$response['success'] = true;
			if ($user->profile_pic) {
				$user->profile_pic = $root . '/public' . '/' . $user->profile_pic;
			}

			if ($user->role == 'seller') {

				$total_award = DB::table('talent_awards')
					->select("*")
					->join('talents', 'talent_awards.talent_id', '=', 'talents.id')
					->where('talents.user_id', '=', $user->id)
					->get()
					->count();
				$user->total_award = $total_award;

				$talents = DB::table('talents')
					->select("*")
				// ->join('roles', 'users.role_id', '=', 'roles.id')
					->where('user_id', '=', $user->id)
					->where('talents.active', '=', 'Active')
					->where('talents.approved', '=', '1')
					->get();
				foreach ($talents as $prod) {
					$f = DB::table('commercial_media')
						->select('commercial_media.image_path')
						->where('commercial_media.talent_id', '=', $prod->id)
						->get();
					foreach ($f as $r) {
						$imag = $r->image_path;
						$root = $request->root();
						$newPath = $root . '/storage' . '/' . $imag;

						// $img1 = array_push($prod->image, $r);
						$extArr = explode(".", $r->image_path);
						$ext = end($extArr);
						$videoExt = array("mp4", "MP4", "mp3", "MP3");
						if (in_array($ext, $videoExt)) {
							$prod->commercial_video = $newPath;
						} else {
							$prod->commercial_video = '';
						}
						$imgExt = array("jpg", "JPG", "JPG", "JPEG", "png", "PNG");
						if (in_array($ext, $imgExt)) {
							$prod->new_image_path = $newPath;
						} else {
							$prod->new_image_path = '';
						}
					}
					$f = DB::table('sample_media')
						->select('sample_media.path_name')
						->where('sample_media.talent_id', '=', $prod->id)
						->get();
					foreach ($f as $r) {
						$imag = $r->path_name;
						$root = $request->root();
						$newPath = $root . '/storage' . '/' . $imag;
						$extArr = explode(".", $r->path_name);
						$ext = end($extArr);
						if ($ext == 'mp4' || $ext == 'MP4' || $ext == 'mp3' || $ext == 'MP3') {
							$prod->sample_video = $newPath;
						} else {
							$prod->sample_video = '';
						}
					}

				}
				$response['talents'] = $talents;
			}
			$response['user_profile'] = $user;
		} else {
			$response['message'] = 'User not exists';
		}
		return json_encode($response);
	}

	public function getMessageCount($chatId, $current_id, $readFlag) {
		$getCount = DB::table('chat_messages')
			->select("*")
			->where('sent_by', '!=', $current_id)
			->where('chat_id', '=', $chatId)
			->where('read_flag', '=', $readFlag)
			->get();
		return $getCount->count();
	}

	public function getUserDeatils($userId) {
		$users = DB::table('users')
			->select("*")
			->where('users.id', '=', $userId)
			->get();
		return $users;
	}

	public function getreadmsg($current_id, Request $request) {

		
		$matchThese = ['sent_by' => $current_id,'received_by' => $current_id];

		$AllUsers['chats'] = DB::table('chats')
			->select("*")
			->orWhere($matchThese)
			->where('msg_status', '=', 1)
			->orderBy('last_activity', 'desc')
			->get();

		$AllUsers['chat_messages'] = DB::table('chat_messages')
		->select("*")
		->where('sent_by', '=', $current_id)
		->where('read_flag', '=', 1)
		->orWhere('read_flag', '=', 0)
		->orderBy('created_at', 'desc')
		->get();

		// dd($AllUsers['chat_messages']->toSql());

		$root = $request->root();
		$newPath = $root . '/public' . '/';

		foreach ($AllUsers['chats'] as $user) {
			// $lastMessage = $this->getLastMessageSatus($user->id, $current_id);
			// if($lastMessage && $lastMessage->read_flag == 1){
			$user->count_msg = $this->getMessageCount($user->id, $current_id, '1');
			if ($user->sent_by != $current_id) {
				$userdata = $this->Profile($user->sent_by);
			} else {
				$userdata = $this->getUserProfile($user->received_by);
			}
			
			$user->chat_id = $user->id;
			$user->message = $user->last_message;
			$user->date = $user->last_activity;
			$user->first_name = isset($userdata->first_name) ? $userdata->first_name : '';
			$user->last_name = isset($userdata->last_name) ? $userdata->last_name : '';
			if (isset($userdata->profile_pic) && $userdata->profile_pic) {
				$user->profile_pic = $userdata->profile_pic;
			} else {
				$user->profile_pic = "";
			}
			// }
		}
		foreach ($AllUsers['chat_messages'] as $user) {
			// $lastMessage = $this->getLastMessageSatus($user->id, $current_id);
			// if($lastMessage && $lastMessage->read_flag == 1){
			$user->count_msg = $this->getMessageCount($user->chat_id, $current_id, '1');
			if ($user->sent_by != $current_id) {
				$userdata = $this->getUserProfile($user->sent_by);
			} else {
				$userdata = $this->getUserProfile($user->received_by);
			}
			
			$user->chat_id = $user->chat_id;
			$user->message = $user->message;
			$user->date = $user->created_at;
			$user->first_name = isset($userdata->first_name) ? $userdata->first_name : '';
			$user->last_name = isset($userdata->last_name) ? $userdata->last_name : '';
			if (isset($userdata->profile_pic) && $userdata->profile_pic) {
				$user->profile_pic = $userdata->profile_pic;
			} else {
				$user->profile_pic = "";
			}
			// }
		}

		return $AllUsers;
	}

	public function getLastMessageSatus($chat_id, $currentUser) {
		$chats = DB::table('chat_messages')
			->select('*')
			->where('chat_id', '=', $chat_id)
			->where('sent_by', '!=', $currentUser)
			->orderBy('id', 'desc')
			->first();
		if ($chats) {
			return $chats;
		} else {
			return false;
		}

	}

	public function getunreadmsg($current_id, Request $request) {

		$matchThese = ['sent_by' => $current_id,'received_by' => $current_id];

		$AllUsers['chats'] = DB::table('chats')
			->select("*")
			->orWhere($matchThese)
			->where('msg_status', '=', 0)
			->orderBy('last_activity', 'desc')
			->get();

		$root = $request->root();
		$newPath = $root . '/public' . '/';

		$AllUsers['chat_messages'] = DB::table('chat_messages')
		->select("*")
		->where('received_by', '=', $current_id)
		->where('read_flag', '=', 0)
		->orderBy('created_at', 'desc')
		->get();

		foreach ($AllUsers['chats'] as $user) {
			// $lastMessage = $this->getLastMessageSatus($user->id, $current_id);
			// if($lastMessage && $lastMessage->read_flag == 1){
			$user->count_msg = $this->getMessageCount($user->id, $current_id, '0');
			if ($user->sent_by != $current_id) {
				$userdata = $this->getUserProfile($user->sent_by);
			} else {
				$userdata = $this->getUserProfile($user->received_by);
			}
			$user->chat_id = $user->id;
			$user->message = $user->last_message;
			$user->date = $user->last_activity;
			$user->first_name = isset($userdata->first_name) ? $userdata->first_name : '';
			$user->last_name = isset($userdata->last_name) ? $userdata->last_name : '';
			if (isset($userdata->profile_pic) && $userdata->profile_pic) {
				$user->profile_pic = $userdata->profile_pic;
			} else {
				$user->profile_pic = "";
			}
			// }

		}
		foreach ($AllUsers['chat_messages'] as $user) {
			// $lastMessage = $this->getLastMessageSatus($user->id, $current_id);
			// if($lastMessage && $lastMessage->read_flag == 1){
			$user->count_msg = $this->getMessageCount($user->chat_id, $current_id, '1');
			if ($user->sent_by != $current_id) {
				$userdata = $this->getUserProfile($user->sent_by);
			} else {
				$userdata = $this->getUserProfile($user->received_by);
			}
			
			$user->chat_id = $user->chat_id;
			$user->message = $user->message;
			$user->date = $user->created_at;
			$user->first_name = isset($userdata->first_name) ? $userdata->first_name : '';
			$user->last_name = isset($userdata->last_name) ? $userdata->last_name : '';
			if (isset($userdata->profile_pic) && $userdata->profile_pic) {
				$user->profile_pic = $userdata->profile_pic;
			} else {
				$user->profile_pic = "";
			}
			// }

		}
		return $AllUsers;
	}

	public function getUserMsg_old($user_id, $chat_id, Request $request) {

		DB::table('messages')
			->where('sent_by', $receiver_id)
			->where('received_by', $user_id)
			->update(['read_flag' => 1]);

		$all_message = DB::table('messages')
			->where('messages.sent_by', '=', $user_id)
			->where('messages.received_by', '=', $receiver_id)
			->orWhere('messages.sent_by', '=', $receiver_id)
			->where('messages.received_by', '=', $user_id)
			->orderBy('created_at', 'ASC')
			->get();

		$root = $request->root();
		$newPath = $root . '/storage' . '/';
		foreach ($all_message as $message) {
			if ($message->message_media) {
				$message->message_media = $newPath . $message->message_media;
				$message->message_media_name = substr($message->message_media, strrpos($message->message_media, '/') + 1);
			}
		}
		return $all_message;
	}

	public function getUserMsg($user_id, $chat_id, Request $request) {

		$chat_is = ['id' => $chat_id];
		$chat = Chats::where($chat_is)->first();
		$sent_by = $chat['sent_by'];

		DB::table('chat_messages')
			->where('sent_by', '=', $user_id)
			->where('received_by', '=', $chat['sent_by'])
			->where('read_flag', '=', 0)
			->update(['read_flag' => 1]);

		$chats = DB::table('chats')
			->where('id', $chat_id)
			->first();

		$deleteDate = null;

		if ($chats->sent_by == $user_id) {
			$deleteDate = $chats->deleted_sent_by;
		} else if ($chats->received_by == $user_id) {
			$deleteDate = $chats->deleted_received_by;
		}

		if ($deleteDate) {
			$all_message['chat_messages'] = DB::table('chat_messages')
				->where('sent_by', '=', $user_id)
				->where('received_by', '=', $chat['sent_by'])
				->where('created_at', '>', $deleteDate)
				->orderBy('created_at', 'ASC')
				->get();
		} else {
			$matchThese = ['sent_by' => $user_id, 'received_by' => $chat['sent_by']];
			$orThose = ['sent_by' => $chat['sent_by'],'received_by' => $user_id];
			$all_message['chat_messages'] = DB::table('chat_messages')
				->where($matchThese)
				->orWhere($orThose)
				->orderBy('created_at', 'ASC')
				->get();
		}

		$root = $request->root();
		//$newPath = $root . '/storage' . '/';
		$newPath = $root . '/';
		foreach ($all_message['chat_messages'] as $message) {
			$userdata = $this->getUserProfile($message->sent_by);
			if ($userdata->profile_pic) {
				$message->profile_pic = $root . '/' . $userdata->profile_pic;
			} else {
				$message->profile_pic = $root . '/assets/images/buyer/b-acount.png';
			}
			if ($message->message_media) {
				$message->message_media = $newPath . $message->message_media;
				$message->message_media_name = substr($message->message_media, strrpos($message->message_media, '/') + 1);
			}
		}
		$chat_array = ['sent_by' => $sent_by,'received_by' => $user_id];
		$all_message['chats'] = Chats::where($chat_array)->get();
		
		return $all_message;
	}

	public function store_user_msg(Request $request) {

		ini_set('post_max_size', '100M');
		ini_set('upload_max_filesize', '100M');
		$date = date('Y-m-d H:i:s');
		$input = $request->all();
		// print_r($input);
		$data = array(
			'sent_by' => $input['currentUser'],
			'received_by' => $input['received_by'],
			'message' => $input['message'],
			'message_media' => null,
		);

		$message_file = $request->file('message_file');
		if ($message_file) {
			$fileName = $message_file->getClientOriginalName();
			$fileName1 = $input['currentUser'] . '-' . date("YmdHis") . str_replace(" ", "-", $fileName);
			$pathName = ('uploads/message-media/' . $fileName1);
			//$path = storage_path();
			$path = public_path();
			$message_file->move($path . '/uploads/message-media/', $fileName1);
			$data['message_media'] = $pathName;
		}

		$chatId = $this->enForceChat($data);
		if ($chatId) {
			$lastMessage = DB::table('chat_messages')
				->select('*')
				->where('chat_id', '=', $chatId)
				->orderBy('id', 'desc')
				->first();

			$messageData = array(
				"chat_id" => $chatId,
				'sent_by' => $input['currentUser'],
				'received_by' => $input['received_by'],
				"message" => $data['message'],
				"message_media" => $data['message_media'],
				"created_at" => $date,
			);
			
			// $store_msg=DB::table('chat_messages')->insert($messageData);
			$store_msg_id = DB::table('chat_messages')->insertGetId($messageData);

			$chats = DB::table('chat_messages')
				->select('*')
				->where('id', '=', $store_msg_id)
				->first();

			$updateData = array(
				'last_activity' => $date,
				'last_message_sender' => $data['sent_by'],
				'last_message' => $data['message'],
				'message_media' => $data['message_media'],
			);

			$auto_reply = null;

			if ($lastMessage) {
				$current_time = $date;
				$hourdiff = round((strtotime($current_time) - strtotime($lastMessage->created_at)) / 3600, 1);

				$userSetting = $this->getUserSetting($input['received_by']);
				if ($hourdiff > 24 && $userSetting->auto_reply == 1) {
					$messageData1 = array(
						"chat_id" => $chatId,
						"sent_by" => $input['received_by'],
						"message" => $userSetting->automatic_message,
						"message_media" => '',
					);
					// $store_msg_id1 = DB::table('chat_messages')->insertGetId($messageData1);

					$updateData = array(
						'last_activity' => $date,
						'last_message_sender' => $input['received_by'],
						'last_message' => $userSetting->automatic_message,
						'message_media' => '',
					);

					$auto_reply = DB::table('chat_messages')
						->select('*')
						->where('id', '=', $store_msg_id1)
						->first();

				}
			}

			// DB::table('chats')
			// 	->where('id', $chatId)
			// 	->update($updateData);

			$root = $request->root();
			//$newPath = $root . '/storage' . '/';
			$newPath = $root . '/';
			
			$userdata = $this->getUserProfile($data['sent_by']);
			if ($userdata->profile_pic) {
				$chats->profile_pic = $root . '/' . $userdata->profile_pic;
			} else {
				$chats->profile_pic = $root . '/assets/images/buyer/b-acount.png';
			}
			
			if ($chats->message_media) {
				$chats->message_media = $newPath . $chats->message_media;
				$chats->message_media_name = substr($chats->message_media, strrpos($chats->message_media, '/') + 1);
			}

			$response = array(
				"success" => true,
				"message" => 'Successfully sent',
				"last_chat" => $chats,
				"auto_reply" => $auto_reply,
			);
			return json_encode($response);
		} else {
			$response = array(
				"success" => false,
				"message" => 'Message not sent',
			);
			return json_encode($response);
		}

	}

	public function getUserSetting($user_id) {
		$user = DB::table('users')
			->select('*')
			->where('id', '=', $user_id)
			->first();
		return $user;
	}

	public function enForceChat($data) {
		$chats = DB::table('chats')
			->select('*')
			->where('sent_by', '=', $data['received_by'])
			->where('received_by', '=', $data['sent_by'])
			->first();

		if (!$chats) {
			$chats = DB::table('chats')
				->select('*')
				->where('sent_by', '=', $data['received_by'])
				->where('received_by', '=', $data['sent_by'])
				->first();
		}
		if (!$chats) {
			$insData = array(
				'sent_by' => $data['sent_by'],
				'received_by' => $data['received_by'],
				'last_message_sender' => $data['sent_by'],
				'last_message' => $data['message'],
				'message_media' => $data['message_media'],
			);

			// $lastId = DB::table('chats')->insertGetId($insData);
			// $newChat = DB::table('chats')->insert($insData);

			// return $lastId;
		}
		return $chats->id;
	}

	public function check_is_favrate($currentUser, $favrate_id) {

		$users = DB::table('favriote_user')
			->where('user_id', '=', $currentUser)
			->where('fav_user_id', '=', $favrate_id)
			->count();

		$users1 = array('is_fav' => $users);
		return json_encode($users1);
	}

	public function add_to_favrate($currentUser, $favrate_id) {
		$data = array(
			'user_id' => $currentUser,
			'fav_user_id' => $favrate_id,
		);
		$check = DB::table('favriote_user')
			->where($data)
			->count();
		if ($check == 0) {
			$add_to_favrate = DB::table('favriote_user')->insert($data);
			if ($add_to_favrate == 1) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}

	}

	public function delete_from_favrate($currentUser, $favrate_id) {
		$delete_from_favratet = DB::table('favriote_user')
			->where('user_id', '=', $currentUser)
			->where('fav_user_id', '=', $favrate_id)
			->delete();
		return $delete_from_favratet;
	}

	public function get_all_fav_contact($currentUser, Request $request) {
		$AllUsers = DB::table('favriote_user')
			->select(array('users.id', 'users.first_name', 'users.last_name', 'users.profile_pic'))
			->join('users', 'users.id', '=', 'favriote_user.fav_user_id')
			->where('favriote_user.user_id', '=', $currentUser)
			->get();
		// print_r($AllUsers);die();

		$root = $request->root();
		foreach ($AllUsers as $user) {
			// print_r($user);die();
			$user->chat_id = $this->checkChatExist($currentUser, $user->id);
			if ($user->profile_pic) {
				$user->new_profile_pic = $root . '/public' . '/' . $user->profile_pic;
			} else {
				$user->new_profile_pic = '';
			}
		}

		return $AllUsers;
	}

	public function checkChatExist($sent_by, $received_by) {
		$chats = DB::table('chats')
			->where('sent_by', '=', $sent_by)
			->where('received_by', '=', $received_by)
			->first();
		if (!$chats) {
			$chats = DB::table('chats')
				->where('received_by', '=', $sent_by)
				->where('sent_by', '=', $received_by)
				->first();
		}
		if ($chats) {
			return $chats->id;
		} else {
			return 0;
		}

	}

	public function get_all_contact($currentUser, Request $request) {
		$AllUsers = DB::table('users')
			->where('id', '!=', $currentUser)
			->where('email_verified', '=', 'yes')
			->orderBy('id', 'desc')
			->limit(20)
			->get();

		$root = $request->root();
		foreach ($AllUsers as $user) {
			$user->chat_id = $this->checkChatExist($currentUser, $user->id);
			if ($user->profile_pic) {
				$user->new_profile_pic = $root . '/public' . '/' . $user->profile_pic;
			} else {
				$user->new_profile_pic = '';
			}
		}
		return $AllUsers;
	}

	public function contact_search($currentUser, Request $request) {
		$response = array();
		$response['success'] = false;
		$response['message'] = '';

		$inputString = ($request->query('name')) ? $request->query('name') : '';

		$AllUsers = DB::table('users')
			->where('id', '!=', $currentUser)
			->where('email_verified', '=', 'yes')
			->where(function ($query) use ($inputString) {
				$query->where('first_name', 'LIKE', "%" . $inputString . "%")
					->orWhere('last_name', 'LIKE', "%" . $inputString . "%");
			})
			->orderBy('id', 'desc')
			->limit(20)
			->get();
		// print_r(DB::getQueryLog());die();

		$root = $request->root();
		if ($AllUsers) {
			$response['success'] = true;
			foreach ($AllUsers as $user) {
				$user->chat_id = $this->checkChatExist($currentUser, $user->id);
				if ($user->profile_pic) {
					$user->new_profile_pic = $root . '/public' . '/' . $user->profile_pic;
				} else {
					$user->new_profile_pic = '';
				}
			}
			$response['contacts'] = $AllUsers;
		} else {
			$response['message'] = 'No contacts found';
		}

		return json_encode($response);
	}

// SELECT COUNT(read_flag) FROM `messages` WHERE read_flag=0 and received_by=45
	public function get_unread_count($currentUser) {
		$count = 0;

		$chatIds = $this->getChatIds($currentUser);

		foreach ($chatIds as $chat) {
			$res = $this->getMessageCount($chat->id, $currentUser, '0');
			$count += $res;
		}

		$response = array(
			"unread_count" => $count,
		);

		return json_encode($response);

		// $get_real_count=DB::table('chat_messages')
		//     ->where('read_flag', '=', "0")
		// 	->Where('received_by' , '=' , $currentUser)
		// 	->count();
		// if($get_real_count){
		// 	return $get_real_count;
		// }else{
		// 	return null;
		// }
	}

	public function getChatIds($userid) {
		$chatIds = DB::table('chats')
			->where('sent_by', '=', $userid)
			->orWhere('received_by', '=', $userid)
			->get();
		return $chatIds;
	}

	//----------Delete message---

	public function delete_message($currentUser, $chatid) {
		$chats = DB::table('chats')
			->where('id', '=', $chatid)
			->first();

		if ($chats->sent_by == $currentUser) {
			$data = array(
				'last_message' => '',
				'message_media' => '',
				'deleted_sent_by' => date('Y-m-d H:i:s'),
			);
		}
		if ($chats->received_by == $currentUser) {
			$data = array(
				'last_message' => '',
				'message_media' => '',
				'deleted_received_by' => date('Y-m-d H:i:s'),
			);
		}

		$delete_chat = DB::table('chats')
			->where('id', '=', $chatid)
			->update($data);
		// $delete_chat_msg = DB::table('chat_messages')
		// 		->where('chat_id','=', $chatid)
		// 		->delete();
		return $delete_chat;
	}

	//----------Delete All message---

	public function delete_allmessage($userid) {

		$response = array();
		$response['success'] = false;

		$chatIds = DB::table('chats')
			->where('received_by', '=', $userid)
			->orWhere('sent_by', '=', $userid)
			->get();

		// print_r($chatIds);die();
		// Delete chat list
		// $delete_msg=DB::table('chats')
		// 		->where('received_by' ,'=' ,$userid)
		// 		->orWhere('sent_by' , '=' , $userid)
		// 		->delete();

		// Remove from favourite
		// $delete_from_favratet=DB::table('favriote_user')
		// 		->where('user_id','=', $userid)
		// 		->delete();
		// return $delete_from_favratet;

		// delete chat messages
		foreach ($chatIds as $chatid) {
			if ($chatid->sent_by == $userid) {
				$data = array(
					'last_message' => '',
					'message_media' => '',
					'deleted_sent_by' => date('Y-m-d H:i:s'),
				);
			}
			if ($chatid->received_by == $userid) {
				$data = array(
					'last_message' => '',
					'message_media' => '',
					'deleted_received_by' => date('Y-m-d H:i:s'),
				);
			}

			$delete_chat = DB::table('chats')
				->where('id', '=', $chatid->id)
				->update($data);
			// $delete_chat_msg = DB::table('chat_messages')
			// 	->where('chat_id','=', $chatid->id)
			// 	->delete();
		}

		$response['success'] = true;

		return $response;
	}

	public function autoreplySetting(Request $request) {
		$input = $request->all();

		$userId = $input['user_id'];

		$response = array();
		$response['success'] = false;
		$response['message'] = '';

		$data = array(
			'auto_reply' => $input['auto_reply'],
			'automatic_message' => $input['message'],
		);

		$res = DB::table('users')
			->where('id', '=', $userId)
			->update($data);

		// if ($res) {
		$response['success'] = true;
		$response['message'] = 'Setting Saved';
		// } else {
		// 	$response['message'] = 'Could not save your setting';
		// }
		return json_encode($response);
	}

	public function addViewsCount(Request $request) {
		$response = array();
		$response['success'] = false;

		$input = $request->all();
		$data = array(
			'seller_plan_id' => $input['seller_plan_id'],
			'plan_id' => $input['plan_id'],
			'ad_id' => $input['ad_id'],
			'user_id' => $input['user_id'],
		);

		$ad_result = DB::table('commercial_ad_views')->insertGetId($data);
		if ($ad_result) {
			$response['success'] = true;
			$response['message'] = "View count addedd";
		} else {
			$response['message'] = "Could not add view count";
		}
		return json_encode($response);
	}

}
