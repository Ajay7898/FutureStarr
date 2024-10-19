<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesControllera extends Controller
{
    public function index(){

    	return view('frontend.footer-pages.privacy-page');
    }
    public function termsAndConditions() {
     
    	return view('frontend.footer-pages.terms-conditions', compact('metaTags'));
    }
    public function refundPolicy() {

    	return view('frontend.footer-pages.refund-policy');
    }
}
