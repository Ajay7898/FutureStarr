<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Log;
use DB;
use \Illuminate\Support\Str;
use App\Models\TalentAwards;
use App\Models\UserCart;
use App\Models\BuyerContact;
use App\Traits\MailsendTrait;
use App\Models\TalentRating;
use Validator;
use URL;
use Session;
use Redirect;
// use Illuminate\Support\Facades\Input;
use App\Models\Plans;
use App\Models\SellerPlans;
use App\Models\CustomPlan;
use App\Models\PaymentHistory;
use Auth;
use DateTime;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends HomeController {
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal() {
        return view('paywithpaypal');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request) {
        $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
        $amt = $request['amount'];
        $title = $request['title'];
        $quantity = $request['quantity'];

        $planId = session::put('planId', $request['plan_id']);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($title)
        /** item name **/->setCurrency('USD')->setQuantity(1)->setPrice($amt);
        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')->setTotal($request->get('amount'));
        $transaction = new Transaction();

        $transaction->setAmount($amount)->setItemList($item_list)->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
        /** Specify return URL **/->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')->setPayer($payer)->setRedirectUrls($redirect_urls)->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        }
        catch(\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::flash('error', 'Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::flash('error', 'Unknown error occurred');
        return Redirect::route('addmoney.paywithpaypal');
    }
    public function getPaymentStatus(Request $request) {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
       
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        $id = $request->get('PayerID');
        if (empty($id) || empty($request->get('token'))) {
            \Session::flash('error', 'Payment failed');
            return Redirect::route('addmoney.paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') {
               $planId = session::get('planId');
               $getPlan = SellerPlans::where('user_id','=',Auth::user()->id)->count();

               $activePlanWhere = ['user_id' => Auth::user()->id];
               $today = date('Y-m-d h:i:s');
               $checkPlanExpiredOrNot = SellerPlans::where($activePlanWhere)->where('start_date','<=',$today)->where('end_date','>=',$today)->first();
               $getClicks = Plans::find($planId);
               if(!empty($checkPlanExpiredOrNot)){

                   $fdate = $checkPlanExpiredOrNot['end_date'];
                   $tdate = date('Y-m-d h:i:s');
                   $datetime1 = new DateTime($fdate);
                   $datetime2 = new DateTime($tdate);
                   $interval = $datetime1->diff($datetime2);
                   $days = $interval->format('%a');
                   $numDays = 30 + $days;
                   $adClicksRemaining = $checkPlanExpiredOrNot['total_ads'];
                   $adClcikPermonth = $adClicksRemaining + $getClicks['clicks'];
               } else {
                   $adClcikPermonth = $getClicks['clicks'];
                   $numDays = 30;
               }
               
               $startDate = Carbon::now()->format('Y-m-d h:i:s');
               $endDate = Carbon::now()->addDays($numDays);
               $sellerPlanArray = [
                         'plan_id' => $planId,
                         'total_ads' => $adClcikPermonth,
                         'user_id' => !empty(Auth::user()->id)?Auth::user()->id:'',
                         'start_date' => $startDate ,
                         'end_date' => $endDate,
                         'created_by' => !empty(Auth::user()->id)?Auth::user()->id:'',
                         'updated_by' => !empty(Auth::user()->id)?Auth::user()->id:'',
                    ];   
               $paymentHistoryArray = [ 
                        'user_id' => !empty(Auth::user()->id)?Auth::user()->id:'',
                        'transaction_id' => $result->id,
                        'token' => $result->cart,
                        'PayerID' => $result->payer_id,
                        'amount' => $request['amount'],
                        'description' => 'Commercial ad plans',
                        'transaction_payload' => json_encode($result),
                    ];
               if(empty($getPlan)) {
                    $sellerPlan = SellerPlans::insert($sellerPlanArray); 
                    if(!empty($sellerPlan)) {
                        $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                        if(!empty($addPyamentDetails)) {
                            Session::flash('success','Commercial ads plan purchased succesfully.');
                            return redirect(route('payment.success')); 
                        }
                      }    
                } else {
                     $createPlan = SellerPlans::where('user_id','=',Auth::user()->id)->update($sellerPlanArray);
                     if(!empty($createPlan))  {
                        $addPyamentDetails = DB::table('payment_history')->insert($paymentHistoryArray);
                        if(!empty($addPyamentDetails)) {
                            Session::flash('success','Plan upgraded succesfully.');
                            return redirect(route('payment.success')); 
                        }
                     }
                }
             
        } else {
               return redirect(route('payment.cancel'));
        }
    }

    public function paymentCancel(Request $request) {
       if(!empty(Auth::check())) {
              return view('frontend.seller.payment.payment-cancel');
       } else {
          Session::flash('info', 'You must be login firstly.');
            return redirect('/');
       } 
    }

    public function paymentSuccess(Request $request) {
       if(!empty(Auth::check())) {
               return view('frontend.seller.payment.thank-you');
       } else {
          Session::flash('info', 'You must be login firstly.');
            return redirect('/');
       } 
    }
}
