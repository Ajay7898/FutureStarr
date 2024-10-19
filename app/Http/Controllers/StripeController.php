<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\SellerStripeAccounts;
use App\Models\PurchasedProduct;
use App\Models\BuyerProducts;
use App\Models\PaymentHistory;
use DB;
use Session;

class StripeController extends Controller
{
	/**
	* Functiona Name: index
	* Description: Handle stripe connected accounts 
	*/
    public function index(Request $request) {
    	if (!empty(Auth::check())) {
                $seller_fs_id = !empty(Auth::user()->id)?Auth::user()->id:'';   
                try {
                	 require_once('../vendor/stripe/stripe-php/init.php');
                     //require_once('stripe/vendor/autoload.php');
			        \Stripe\Stripe::setApiKey('sk_live_1SrQHEEtaL5AoCdXh01g9Hlk00tahEU3g3');
			        if ($request->has('code')) {
			            $authCode  = $request->input('code');
			        }
					$response = \Stripe\OAuth::token([
					  'grant_type' => 'authorization_code',
					  'code' => $authCode,
					]);    
					$connected_account_id = $response->stripe_user_id;
			        $seller_fs_id = !empty(Auth::user()->id)?Auth::user()->id:'';
			        
			        $stripeDetailArray = [
			        	     'user_id' => $seller_fs_id,
			        	     'account_id' => $connected_account_id,
			        	     'token_type' => $response->token_type,
			        	     'scope' => $response->scope
			        	];
			        $addStripeAccount = SellerStripeAccounts::create($stripeDetailArray);
			        if(!empty($addStripeAccount)) {
	                    Session::flash('success', 'Your stripe account has been successfully connected with FutureStarr.');
	                    return redirect('/seller/my-product');
	                }
                }
                catch(ModelNotFoundException $err) {
                    Session::flash('error', 'Error.');
                    return redirect('/seller/my-product');
                }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }

    public function payithStripe(Request $request) {
       
        $splitArray = explode(',',$request['sellers']);
        if(!empty($splitArray)) {
          $myArray = [];
          foreach ($splitArray as  $value) {
          	  $split = explode("-",$value);
              $myArray['seller_id'][] = $split[0]; 
              $myArray['seller_amount'][] = $split[1]; 
          }
        }
        $transferArray = array_combine($myArray['seller_id'],$myArray['seller_amount']);
        if(!empty($transferArray)){
            $futureStarrFund = 0;
            $sellersFund = [];
	        foreach($transferArray as $key => $value) {
	        	$fsFund =  floor(($value * 30)) / 100;
	        	$futureStarrFund += $fsFund;
	        	$sellersFund['seller_fund'][$key][] = floor(($value * 70)) / 100;	
	        }
        }
        $futureStarrFund1 = $request['total_amount']; 
        if(!empty($sellersFund) && !empty($futureStarrFund)) {

            	//require_once('stripe/vendor/autoload.php');
                require_once('../vendor/stripe/stripe-php/init.php');
		        \Stripe\Stripe::setApiKey('sk_live_1SrQHEEtaL5AoCdXh01g9Hlk00tahEU3g3');
		      	$charge = \Stripe\Charge::create([
				  "amount" => (int)round($futureStarrFund1)*100,
				  "currency" => "usd",
				  "source" => "tok_visa",
				  "transfer_group" => "{ORDER10}",
				]);
            if($charge['status']=='succeeded') {
            	 foreach ($sellersFund as $key => $value) {
	                foreach($value as $innerKey => $innerValue) {
	                    $sellerConnectAccountId = SellerStripeAccounts::where('user_id','=',$innerKey)->first();
					    $transfer = \Stripe\Transfer::create([
						  "amount" => (int)round($innerValue[0])*100,
						  "currency" => "usd",
						  "source_transaction" => $charge['id'],
						  "destination" => $sellerConnectAccountId['account_id'],
						  
						]); 
	                }
				}
				$paymentHistoryArray = [ 
					          'user_id' => !empty(Auth::user()->id)?Auth::user()->id:'',
					          'transaction_id' => $charge['balance_transaction'],
					          'token' => $charge['id'],
					          'PayerID' => !empty(Auth::user()->id)?Auth::user()->id:'',
					          'talent_id' => $request['talent_id'],
					          'amount' => $request['total_amount'],
					          'description' => 'Talent Purchase',
					          'transaction_payload' => json_encode($charge),
				           ];
				    
				$addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
				$userId = !empty(Auth::user()->id)?Auth::user()->id:'';
				$condition = ['purchased_products.user_id' => $userId, 'purchased_products.delete_flag'=> 0]; 
                $getPurchasedProduct = PurchasedProduct::where($condition)->get();
                if(!empty($getPurchasedProduct)) {
                	$array = array();
                	foreach($getPurchasedProduct as $value) {
                		  $sellerId = sellerId($value->talent_id);
                          $array[] = array(
					        'user_id' => $sellerId,
					        'buyer_id' => $userId,
					        'talent_id' => $value->talent_id,
					        'active' => 1,
					        'date' => date('Y-m-d'),
					        'created_by' => $userId, 
					        'upadted_by' => $userId,
					    );
                	}
                	$addedPurchasedProducts = BuyerProducts::insert($array);
                	if(!empty($addedPurchasedProducts)) {
                	   $updateArray = ['delete_flag' => 1];
                       $makeCartEmpty = PurchasedProduct::where($condition)->update($updateArray);
                       if(!empty($makeCartEmpty)) {
                       	  return view('frontend.buyer.thank-you');
                       }
                	}
                }
	         } else {
	         	  return view('frontend.buyer.cancel');
	         }
        } 
    }
}
