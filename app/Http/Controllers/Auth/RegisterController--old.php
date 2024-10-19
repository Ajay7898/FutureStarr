<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use App\Traits\MailsendTrait;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use MailsendTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

     if($data['role_id'] =='3'){
        
         Session::flash('buyer','buyer');
         return Validator::make($data, [

            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => 'required'

         ]);

    } elseif ($data['role_id'] =='4') {

         Session::flash('seller','seller');
         return Validator::make($data, [

            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'g-recaptcha-response' => 'required'

         ]);
    }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      if($data['role_id'] =='3') {
        
        $user =  User::create([
            'role_id' => $data['role_id'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make(strtolower($data['password'])),
            'public_profile' => 'buyer/'.$data['firstname'].'-'.$data['lastname'].'-'.substr(md5(rand()), 0, 11)
        ]);
         $this->registerEmailToAdmin($data);
         $this->registerEmailToBuyer($data,$data['email']);
         Session::flash('success','Thank you for regisreted as buyer with futurestarr.');
         return $user;

      } elseif ($data['role_id'] =='4') {
        
        $user =  User::create([
            'role_id' => $data['role_id'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make(strtolower($data['password'])),
            'public_profile' => 'seller/'.$data['firstname'].'-'.$data['lastname'].'-'.substr(md5(rand()), 0, 11)
        ]);
          $this->registerEmailToAdmin($data);
          $this->registerEmailToSeller($data,$data['email']);
          Session::flash('success','Thank you for regisreted as seller with futurestarr.');
          return $user;
      }
    }
}
