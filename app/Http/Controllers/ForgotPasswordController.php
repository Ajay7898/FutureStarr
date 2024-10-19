<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserToken;
use App\Traits\MailsendTrait;
use Response;
use Hash;
use Session;

class ForgotPasswordController extends Controller
{
	use MailsendTrait;

	public function index(Request $request){
		if($request->ajax()){
			if(!empty($request['email'])){
				$user = User::where('email','=',$request['email'])->first();
				if(!empty($user)){
					UserToken::where('user_id', $user->id)->delete();
					$userToken = new UserToken();
					$userToken->user_id = $user->id;
					$userToken->token = md5(microtime().rand());
					$userToken->save();
					$token = $userToken->token;
					$this->sendForgotPasswordMail($user,$token);
					$response = ['success' => 'We have sent email,please check your inbox to reset password.'];
					return Response::json($response);
				} else {
					$response = ['warning' => 'It seems you are not registred yet with futureStarr,Please create an account.'];
					return Response::json($response);
				}
			} else {
				$response = ['error' => 'Please enter a valid email address.'];
				return Response::json($response);
			}
		}
	}
	public function resetPassword(Request $request) {
		return view('frontend.password.forgot-password');
	}
	public function updatePassword(Request $request) {

		if(!empty($request->all())) {
			$this->validate($request, [
              'password' => 'required|string|min:6|confirmed',
             ]);
			try{
				$userToken = UserToken::where('token','=',$request['token'])->first();
				if($userToken){
					$user = User::find($userToken->user_id);
					$user->password = \Hash::make($request['password']);
					$user->save();
					UserToken::where('token','=',$request['token'])->delete();

					Session::flash('success', 'Your password has been reset successfully.');
					return redirect('/');
				}
				Session::flash('error', 'Password is not set,please try again later.');
				return redirect('/');
			}catch(\Exception $e){
				Session::flash('error', 'Inernal server error.');
				return redirect('/');
			}
		}
	}
}
