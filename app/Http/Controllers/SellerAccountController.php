<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\SellerInboxes;
use App\Models\TotalDownloads;
use Session;
use Route;
use Response;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Validator;

class SellerAccountController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {
             $id = !empty(Auth::user()->id)?Auth::user()->id:'';
             $condition =['id' => $id];
             $userInfo = User::Where($condition)->with('getUserRole','getMessages','getTotalDownloads')->get();
             dd($userInfo);
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
    }
    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBuyerProduct(Request $request) {
        if (Auth::check()) {
            $id = !empty(Auth::user()->id)?Auth::user()->id:'';
            if ($request->ajax()) {
                if (!empty($request->all())) {
                    try {
                        $condition = ['buyer_id' => $request['buyer_id'], 'user_id' => $id,'talent_id'=>$request['talent_id']];
                        $checkProduct = BuyerProduct::where($condition)->first();
                        if (!empty($checkProduct)) {
                            $active = 0;
                            $productArray = ['active'=> $active];
                            $updatedId = BuyerProduct::where($condition)->update($productArray);
                            if (!empty($updatedId)) {
                                $response = ['success' => 'Product deleted successfully.'];
                                return Response::json($response);
                            } else {
                                $response = ['error' => 'Unable to delete the product.'];
                                return Response::json($response);
                            }
                        }
                    }
                    catch(ModelNotFoundException $err) {
                        $response = ['warning' => 'Something went wrong.Unable to delete the Product at a moment.'];
                        return Response::json($response);
                    }
                }
            } else {
                Session::flash('warning', 'Bad Request');
                return redirect('/');
            }
        } else {
            Session::flash('info', 'You must be login firstly.');
            return redirect('/');
        }
    }
    