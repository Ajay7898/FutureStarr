<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Session;

class SiteConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $settings = [];
        $settings = Setting::find(1);

        return view('admin.site-config.index', compact('settings'));
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

        if($request->all()) {

            $table_array = [
                'email'               => $request->email,
                'address'             => $request->address,
                'contact_number'      => $request->contact_number,
                'work_hours_weekdays' => $request->work_hours_weekdays,
                'work_hours_weekends' => $request->work_hours_weekends,
                'facebook'            => $request->facebook,
                'instagram'           => $request->instagram,
                'twitter'             => $request->twitter,
                'linkedin'            => $request->linkedin,
                'youtube'             =>  $request->youtube
            ];

            $update = Setting::where('id', 1)->update($table_array);

            if(!empty($update)) {
                $toastr = 'success';
                $message = 'Settings updated successfully!'; 
            } else {
                $toastr = 'error';
                $message = 'Not able to update the request. Please try again later';
            }
            
            Session::flash($toastr, $message);
            return redirect( route('admin.site.config') );
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
