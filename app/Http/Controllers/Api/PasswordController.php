<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Role;
use App\Models\UserToken;
use Carbon\carbon;
use Validator;
use App\Traits\MailsendTrait;
use App\Repository\Apis\UserApi;
use Hash;
use Log;
use DB;

class PasswordController extends ApiController
{

  use MailsendTrait;

  /**
   * @var \App\Repository\Apis\UserApi
   * 
   */
  protected $userApi;

  public function __construct(userApi $userApi)
  {
    $this->userApi = $userApi;
  }

  public function forgotPassword(Request $request)
  {

    Log::info("forgot password");
    $email = $request['email'];
    $user = User::where('email', '=', $email)->first();
    try {
      // if user exist then create token and store in UserToken table send an email link to reset password
      if ($user) {
        UserToken::where('user_id', $user->id)->delete();
        $userToken = new UserToken();
        $userToken->user_id = $user->id;
        $userToken->token = md5(microtime() . rand());
        $userToken->save();
        $token = $userToken->token;
        $this->sendForgotPasswordMail($user, $token);
        return $this->respond([
          'status' => 'success',
          'status_code' => $this->getStatusCode(),
          'message' => 'We have sent email on ' . $email . ', Please check your inbox to reset password'
        ]);
      }
      return $this->respondWithError('It seems you are not registred yet with ZenWe, Please create an account', 401);
    } catch (\Exception $e) {
      return $this->respondInternalError($e->getMessage());
    }
  }

  // here we get object in body which contains the token along with new password
  public function setNewUserPasswordRq(Request $request)
  {

    try {

      $rules = array(
        'password'   => 'required|required|min:6|confirmed'
      );

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        return $this->respondValidationError('Fields Validation Failed.', $validator);
      } else {

        $token = $request['token'];
        $password = $request['password'];

        $userToken = UserToken::where('token', '=', $token)->first();
        // dd($userToken);
        if ($userToken) {
          $user = User::find($userToken->user_id);
          $user->password = \Hash::make($password);
          $user->save();

          UserToken::where('token', '=', $token)->delete();
          return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Your password has been reset successfully'
          ]);
        }
        return $this->respondWithError('Password is not set, please try again later');
      }
    } catch (\Exception $e) {
      return $this->respondInternalError('Inernal server error');
    }
  }


  public function resetPassword(Request $request)
  {

    Log::info("reset password");

    $user_id = $request->query('user_id');
    $password = $request['pass'];
    $newpassword = $request['newpassword'];
    $confirmpassword = $request['confirmpassword'];

    Log::info($password);

    try {
      $user = User::where('id', '=', $user_id)->first();

      Log::info("user info " . $user->password);

      if ((Hash::check($password, $user->password)) && $newpassword == $confirmpassword) {
        Log::info("inside if ");

        $resetPassword = DB::table('users')
          ->select('users.password')
          ->where('id', '=', $user_id)
          ->update(['users.password' => \Hash::make($password)]);

        return Response::json('Password is updated successfully!', 200);
      }
      return Response::json('Password is not set,please try again later', 401);
    } catch (\Exception $e) {
      return Response::json('Inernal server error', 500);
    }
  }


  //below function only need for forgot password
  public function validateURL($token = NULL)
  {
    // this function will be called from fron-end when component load
    $userToken = UserToken::where('token', '=', $token)->first();
    if ($userToken) {
      $date1 = $userToken->created_at;
      $date2 = Carbon::now();
      $diff = $date1->diffInMinutes($date2);
      if ($diff <= 15) {
        //return Response::json('Valid url');
        return $this->respond(['status' => 'Success', 'message' => 'Token is valid']);
      }
    }
    //return Response::json('Link got expired',401);
    return $this->respondWithError('Link got expired');
  }
} //class end
