<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\DeletedAccount;
use App\Traits\MailsendTrait;
use Session;
use App\Models\Talents;
use App\Models\Fanbase;
use App\Models\SocialBuzzRiders;
use App\Models\TalentRiders;
use App\SocialFacebookAccount;
use Carbon\Carbon;
use Response;

use Illuminate\Support\Facades\Crypt;

class CommonuserController extends Controller
{
    use MailsendTrait;

    public function index(Request $request) {
        if(!empty(Auth::check())){
        	$user = [];
        	$id = !empty(Auth::user()->id)?Auth::user()->id:'';
        	return view('frontend.common.delete-account', compact('user'));
        } else {
        	Session::flash('info', 'You must be login first.');
        	return redirect('/');
        }
    }

    public function deleteAccount(Request $request) {

      if(!empty(Auth::check())){

              $user = User::find(Auth::user()->id);

              if($user) {

                  $deleteAccountTableArray = [
                         'user_id' => Auth::user()->id,
                         'description' => $request['delete_account'],
                         'account_type' => Auth::user()->role_id,
                         'email' => Auth::user()->email
                     ];

                 Auth::logout();

                 if ($user->delete()) {

                     SocialFacebookAccount::where('user_id', Auth::user()->id)->delete();
                     DeletedAccount::insert($deleteAccountTableArray);
                     $this->accountDeletionEmailToAdmin($deleteAccountTableArray);
                     Session::flash('success', 'Your account has been deleted!.');
                     return redirect('/');
                }
            }

       } else {

           Session::flash('info', 'You must be login first.');
           return redirect('/');

       }
    }
    
    public function newAddedTalentMailToBuyers(Request $request) {
        $talents = Talents::whereDate('date', Carbon::today())->get();
         if(count($talents) > 0 ) {
             $productLinks = [];
             foreach($talents as $value) {
                 $productLinks[] = route('talent.productInfo', $value->slug);
             }
             $buyers = User::where('role_id',3)->get();
              if(count($buyers) > 0) {
                 foreach ($buyers as $buyer) {
                  $this->newTalentEmailToBuyer($productLinks, $buyer);
               }
            }
        }  
    }
}
 