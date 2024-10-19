<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metatags;

class PagesController extends Controller
{
    public function index(){
        $metaTags =  Metatags::where('page_title','=','Privacy-Policy')->first();
    	return view('frontend.footer-pages.privacy-page', compact('metaTags'));
    }
    public function termsAndConditions(){

        $metaTags =  Metatags::where('page_title','=','term-conditions')->first();
    	return view('frontend.footer-pages.terms-conditions', compact('metaTags'));
    }
    public function refundPolicy(){
        $metaTags =  Metatags::where('page_title','=','Refund-policy')->first();
    	return view('frontend.footer-pages.refund-policy', compact('metaTags'));
    }
}
