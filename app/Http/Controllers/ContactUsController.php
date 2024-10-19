<?php

namespace App\Http\Controllers;
use App\Models\ContactUs;
use App\Models\Metatags;
use App\Traits\MailsendTrait;
use Session;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use MailsendTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metaTags =  Metatags::where('page_title','=','Contact Us')->first();
        return view('frontend.contactus.index',compact('metaTags'));
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
           $request->validate([
                'name' => ['required','string', 'max:50'],
                'phone' => ['required','numeric'],
                'email' => ['required'],
                'message' => ['required'],    
                'g-recaptcha-response' => 'required'
            ]);
            $Contactus = new ContactUs();
            $Contactus->name = $request['name'];
            $Contactus->phone = $request['phone'];
            $Contactus->email = $request['email'];
            $Contactus->message = $request['message'];
            $Contactus->save();
            $insertedId = $Contactus->id;
            if(!empty($insertedId)){

                $this->sendConfirmationMail($request['email'], $request['name']);
                $this->sendContactRequestMailToAdmin('custserv@futureStarr.com', 'Futurestarr', $request);

                Session::flash('success', 'Submitted successfully.');
                return redirect('/contact-us');
            } else {
                Session::flash('error', 'Something went wrong.');
                return redirect('/contact-us');
            }   
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
