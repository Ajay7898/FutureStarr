<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class ThankyouController extends Controller
{
    public function index() {

            $authCheck = Auth::check();
        	return view('frontend.thank-you.index', compact('authCheck'));
    }
}
