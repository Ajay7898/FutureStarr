<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboard_data = [];
        Session::flash('success','Welcome to future Starr admin panel.');
        return view('admin.dashboard', compact('dashboard_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $social_share = [];
        return view('admin.social-share' ,  compact('social_share'));
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

    public function change_password() {

         return view('admin.change-password');
    }

    public function update_password(Request $request) {

            $validatedData = $request->validate([
                    'old_password' => 'required',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required'
            ]);

            //echo Hash::check($request->get('old_password'));

            
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {


               
                
                    // The passwords not matches
                    //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
                    //return response()->json(['errors' => ['current'=> ['Current password does not match']]], 422);
                Session::flash('error', 'Current password does not match.');
                return redirect( route('admin.change-password') );
            }
                //uncomment this if you need to validate that the new password is same as old one

            if(strcmp($request->get('old_password'), $request->get('password')) == 0){
                //Current password and new password are same
                //return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
                //return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
                Session::flash('error', 'New Password cannot be same as your current password.');
                return redirect( route('admin.change-password') );
            }
             
            //Change Password
            $user = Auth::user();
            $user->password = Hash::make($request->get('new_password'));
            $updated = $user->save();

            if(!empty($updated)) {
                session::flash('success', 'Password changed successfully!');
                return redirect( route('admin.change-password') );
            } else {
                Session::flash('error', 'Unable to process request. Please try agian later.');
                return redirect( route('admin.change-password') );
            }
            
    }
    
}


