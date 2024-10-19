<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\MailsendTrait;
use App\User;
use Auth;
class EmailNotificationsController extends Controller
{
    use MailsendTrait;

    public function sendAdPlanNotification(Request $request) {
    	$sellerRole = 4;
    	$allSellers = SellerPlans::with('getUserData')->get();
    	if(!empty($allSellers)){ 
    		foreach ($allSellers as $key => $value) {
    			$activePlanWhere = ['user_id' => $value->user_id];
                $today = date('Y-m-d h:i:s');
                $checkPlanExpiredOrNot = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();

                if(empty($checkPlanExpiredOrNot)) {
                     $user = User::find($value->user_id);
                	 $data = array('first_name' => $user['first_name'], 'last_name' => $user['last_name'], 'pathToImage' => '',);
                	 $this->sendEmailNotification($data);
                }
    		}
    	}
    }
}
