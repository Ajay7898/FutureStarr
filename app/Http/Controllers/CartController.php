<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Models\CommercialMedia;
use App\Models\SampleMedia;
use App\Models\Talents;
use App\Models\BuyerProducts;
use Auth;
use Session;
use App\User;
use Exception;
use Response;
use App\Models\UserCarts;

class CartController extends Controller
{

	public function index(Request $request)
	{
		if (!empty(Auth::check())) {
			if (Auth::user()->role_id == '3') {
				try{
					$stripe_customer_id = Auth::user()->stripe_customer_id;
					$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
					$cartData = [];
					$condition = [
						'purchased_products.user_id' => $userId, 
						'purchased_products.delete_flag' => 0,
						'purchased_products.purchased'	=>	null,
					];
					$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();
					if (!empty($purchasedProducts)) {
						$cartData = [];
						foreach ($purchasedProducts as $key => $value) {
							$cartData[$value->getTalent['user_id']][] = $value;
							$group = 'cart_'.$value->cart_id;
						}
					}

					if ($purchasedProducts->isEmpty()) {
						Session::flash('info', 'Your cart is empty');
						return redirect('/');
					}
					$totalAmount = $purchasedProducts->sum('total_amount');
					$totalItems = $purchasedProducts->sum('quantity');

					// stripe payment integration start
					\Stripe\Stripe::setApiKey(env('STRIPE_KEY_TEST'));
					
					$amount = $totalAmount;
					$amount *= 100;
					$amount = (int) $amount;
					$application_fee = (int) $amount * 0.7;
					if ($request->isMethod('post')) {
						if ($request->input('hotpay')) {
							if($stripe_customer_id) {
								// Charge the Customer instead of the card:
								$charge = \Stripe\Charge::create([
									'amount' => $amount,
									'currency' => 'USD',
									'customer' => $stripe_customer_id,
									'transfer_group' => $group,
								]);

								// $paymentIntent = \Stripe\PaymentIntent::create([
								//   'amount' => $amount,
								//   'currency' => 'usd',
								//   'customer' => $stripe_customer_id,
								//   'payment_method_types' => ['card'],
								//   'transfer_group' => $stripe_customer_id,
								// ]);

								// $charge = \Stripe\Charge::create([
								// 	'amount' => $amount,
								// 	'currency' => 'USD',
								// 	'customer' => $stripe_customer_id,
								// 	'transfer_data' => [
								// 	    'amount' => $application_fee,
								// 	    'destination' => 'acct_1EeMQHDDEqW93OvQ',
								// 	],
								// ]);

								// // Create a Transfer to a connected account (later):
								$transfer = \Stripe\Transfer::create([
								  'amount' => $application_fee,
								  'currency' => 'usd',
								  'destination' => 'acct_1EeMQHDDEqW93OvQ',
								  'transfer_group' => $group,
								  "source_transaction" => $charge['id'],
								]);

								// Create a second Transfer to another connected account (later):
								// $transfer = \Stripe\Transfer::create([
								//   'amount' => $application_fee,
								//   'currency' => 'usd',
								//   'destination' => 'acct_1FhJghJtQv3ElrNz',
								//   'transfer_group' => $group,
								//   "source_transaction" => $charge['id'],
								// ]);
								
								Session::flash('success', 'Success! Your payment was successful!');
							}
						}else{
							$token = $request->input('stripeToken');
							$card_number = $request->input('card_number');
							$stripe_customer_id = Auth::user()->stripe_customer_id;
							if(!$stripe_customer_id) {
								//Create a Customer:
								$customer = \Stripe\Customer::create([
									'card' => $token,
									'email' => Auth::user()->email,
								]);
								$stripe_customer_id = $customer->id;
							}else{
								\Stripe\Customer::update($stripe_customer_id, [
									'source' => $token,
								]);
							}
							
							$user = User::find(Auth::user()->id);
							$user->stripe_customer_id = $stripe_customer_id;
							$user->save();

							$charge = \Stripe\Charge::create([
								'amount' => $amount,
								'currency' => 'USD',
								'customer' => $stripe_customer_id,
								'transfer_group' => $group,
							]);

							$transfer = \Stripe\Transfer::create([
							  'amount' => $application_fee,
							  'currency' => 'usd',
							  'destination' => 'acct_1EeMQHDDEqW93OvQ',
							  'transfer_group' => $group,
							  "source_transaction" => $charge['id'],
							]);

							// $transfer = \Stripe\Transfer::create([
							//   'amount' => $application_fee,
							//   'currency' => 'usd',
							//   'destination' => 'acct_1FhJghJtQv3ElrNz',
							//   'transfer_group' => $group,
							//   "source_transaction" => $charge['id'],
							// ]);
							
							Session::flash('success', 'Success! Your payment was successful!');
						}
						// return $charge;
						if ($charge->status == 'succeeded') {
							
							$pps = PurchasedProduct::where($condition)->get();
							// return $pp;
							foreach ($pps as $key => $pp) {
								$bp 	=	new BuyerProducts;
								$bp->user_id	=	Talents::find($pp->talent_id)
													->first()->user_id;
								$bp->buyer_id	=	Auth::id();
								$bp->talent_id	=	$pp->talent_id;
								$bp->active 	=	1;
								$bp->date 		=	date('Y-m-d');
								$bp->created_by	=	Auth::id();
								$bp->updated_by	=	Auth::id();
								$bp->pp_id		=	$pp->id;
								$bp->save();
								// return $bp;
							}

							PurchasedProduct::where($condition)->update([
								'purchased'	=>	1,
							]);
						
							return redirect('/');
						}
					}
					
					

					$payment_intent = \Stripe\PaymentIntent::create([
						'description' => 'Stripe Test Payment',
						'amount' => $amount,
						'currency' => 'USD',
						'description' => 'Payment From CodeTestDev',
						'payment_method_types' => ['card'],						
					]);

					$intent = $payment_intent->client_secret;
					return view('frontend.cart.index', compact('cartData', 'totalAmount', 'totalItems', 'intent', 'stripe_customer_id'));
				}catch(Exception $e) {
                    Session::flash('error', 'Error:'.$e->getMessage());
                    return redirect('/');
                }
				// stripe payment integration end
			} else {
				Session::flash('info', 'Please login from buyer account to purchase the items.');
				return redirect('/');
			}
		} else {
			Session::flash('info', 'You must be login firstly.');
			return redirect('/');
		}
	}
	
	public function deleteCartItem(Request $request) {
		
		if(!empty(Auth::check())) {
			if(!empty($request->all())) {
				 $cartItemId = $request['id'];
				 $condition = ['id' => $cartItemId];
				 $updateArray = ['delete_flag' => 0];
				 $update = PurchasedProduct::where($condition)->update($updateArray);
				 $cart_id = PurchasedProduct::where($condition)->first()->cart_id;
				$product_price = PurchasedProduct::where('cart_id', $cart_id);
		 		$product_price->where('delete_flag', 0);
				$total = $product_price->get()->pluck('total_amount')->sum();
				$quantity = $product_price->get()->pluck('quantity')->sum();

				 
				 return UserCarts::where('id', $cart_id)->update([
				 	'total_amount'	=>	$total,
				 	'quantity'		=>	$quantity,
				 ]); 
				 if(!empty($update)) {
				 	 $response = ['success' => 'Product removed from the cart.'];
                     return Response::json($response);
				 } else {
				 	 $response = ['error' => 'Unable to remove the product from the cart.'];
                     return Response::json($response);
				 }
			}
		} else {
			 Session::flash('info', 'You must be login firstly.');
             return redirect('/');
		}
	}

	/**
     * Update Card.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
	public function updateCard(Request $request)
    {
		try {
			\Stripe\Stripe::setApiKey(env('STRIPE_KEY_TEST_ST'));
			$last4 = Auth::user()->card_last_four_digit;
			$stripe_customer_id = Auth::user()->stripe_customer_id;
			
			if ($request->isMethod('post')) {
				$token = $request->input('stripeToken');
				\Stripe\Customer::update($stripe_customer_id, [
					'source' => $token,
				]);
				$card_number = $request->input('card_number');
				$card_number_four_digit = substr($card_number, -4);
				$user = User::find(Auth::user()->id);
				if(!$stripe_customer_id) {
					$user->stripe_customer_id = $stripe_customer_id;
				}
				$user->card_last_four_digit = $card_number_four_digit;
				$user->save();
				$last4 = $card_number_four_digit;
				Session::flash('success', 'Card has been updated successfully.');
			}
			return view('frontend.cart.update_card', compact('stripe_customer_id', 'last4'));
		}catch(Exception $e) {
			Session::flash('error', 'Error:'.$e->getMessage());
			return redirect('/');
		}
    }
}
  