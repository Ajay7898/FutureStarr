<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedProduct;
use App\Models\CommercialMedia;
use App\Models\SampleMedia;
use App\Models\Talents;
use Auth;
use Session;
use App\User;
use Exception;
use Response;

class BillingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
			\Stripe\Stripe::setApiKey(env('STRIPE_KEY_LIVE'));
            $stripe_customer_id = Auth::user()->stripe_customer_id;
            $cards = [];
			if($stripe_customer_id) 
            {
                $cards =  \Stripe\Customer::allSources(
                    $stripe_customer_id,
                    ['object' => 'card', 'limit' => 5]
                  );
            }
			if ($request->isMethod('post')) 
            {
                //dd($request->all());
                $token = $request->input('stripeToken');
                $actionType = $request->input('actionType');
                $card_id = $request->input('card_id');
                if(!$stripe_customer_id) 
                {
                    $email = Auth::user()->email;
                    $customer = \Stripe\Customer::create([
                        'card' => $token,
                        'email' => $email,
                    ]);
                    $stripe_customer_id = $customer->id;
                }
                elseif($stripe_customer_id && $actionType == 'addCard')
                {
                    $card = \Stripe\Customer::createSource(
                        $stripe_customer_id,
                        ['source' => $token]
                      );
                    
                }
                elseif($stripe_customer_id && !$actionType && $card_id){
                   
                    $sat = \Stripe\Customer::updateSource(
                        $stripe_customer_id,
                        $card_id,
                        [
                        'exp_month' => $request->input('exp_month'), 
                        'exp_year' => $request->input('exp_year')
                        ]
                      );

                    Session::flash('success', 'Card has been updated successfully.');
                    return response()->json(['success' => true]);
                }
				$user = User::find(Auth::user()->id);
				$user->stripe_customer_id = $stripe_customer_id;
				$user->save();
                Session::flash('success', 'Card has been updated successfully.');
            }
			return view('frontend.buyer.billing-account', compact('stripe_customer_id', 'cards'));
		}catch(Exception $e) {
			Session::flash('error', 'Error:'.$e->getMessage());
			return redirect('/');
		}
    }

    /**
     * Get Card details.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCardDetails(Request $request, $card_id)
    {
        try {
			\Stripe\Stripe::setApiKey(env('STRIPE_KEY_LIVE'));
            $stripe_customer_id = Auth::user()->stripe_customer_id;

            $cards =  \Stripe\Customer::retrieveSource(
                $stripe_customer_id,
                $card_id,
                []
            );
            return response()->json($cards);
		}catch(Exception $e) {
			Session::flash('error', 'Error:'.$e->getMessage());
			return redirect('/');
		}
    }



    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
