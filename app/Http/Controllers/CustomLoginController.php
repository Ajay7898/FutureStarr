<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;


class CustomLoginController extends Controller
{
    // do login Auth
	public function loginUser(Request $request)
	{
		$rules = array('email' => 'required', 'password' => 'required');
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Response::json(array('validation_errors' => $validator->getMessageBag()->toArray()), 400);

		} else {

            $email	       = $request->email;
		    $password      = $request->password;
		    $rememberToken = $request->remember;
			if (Auth::attempt(['email' => $email, 'password' => $password], $rememberToken)) {
				$where = ['email' => $email];
				$user = User::where($where)->first();
				if(!empty($user['role_id']) && $user['role_id'] != 1)  {
                      
                    $registerRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();

	                if($registerRoute =='register') {
	                    $previous_url = route('home');
	                } else {
	                	$previous_url = url()->previous();
	                }
                     $msg = array(
						'status'  => 'success',
						'message' => 'Login Successful!',
						'role_id' => $user['role_id'],
						'url' => $previous_url
					);
                   
				} else {
					 Auth::logout();
                     $msg = array(
							'status'  => 'error',
							'message' => 'Login Fail!.This is unauthorised action.'
						);
				}	
				return response()->json($msg);
			} else {
				$msg = array(
					'status'  => 'error',
					'message' => 'Login Fail!. Username or password is incorrect.'
				);
				return response()->json($msg);
			}
		}
	}
}