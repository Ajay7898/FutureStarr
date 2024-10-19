<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Metatags;
use App\Http\Requests\SeoStoreRequest;
use Session;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seo = [];
        $seo = Metatags::orderBy('id','DESC')->paginate(15);
        return view('admin.seo.index' , compact('seo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seo.setting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeoStoreRequest $request)
    {
        
        $table_array = [
            'page_title' => $request['page_name'],
            'url' => $request['url'],
            'title' => $request['title'],
            'type' => 'test',
            'description' => $request['description'],
            'keywords' => $request['keyword'],
        ];

        $created = Metatags::create($table_array);

        if(!empty($created)) {
           Session::flash('success', 'Created successfully.');
           return redirect(route('admin.seo'));
        } else {
            Session::flash('error', 'Technical Error.');
            return redirect(route('admin.seo.setting'));
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
        $seo  = [];
        $seo = Metatags::find($id);
        return view('admin.seo.setting', compact('seo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSeoRequest $request, $id)
    {
        $table_array = [
            'page_title' => $request['page_name'],
            'url' => $request['url'],
            'title' => $request['title'],
            'type' => 'test',
            'description' => $request['description'],
            'keywords' => $request['keyword'],
        ];
       
        $updated = Metatags::where('id', $id)->update($table_array);

        if(!empty($updated)) {
           Session::flash('success', 'Updated successfully.');
           redirect(route('admin.seo'));
        } else {
            Session::flash('error', 'Technical Error.');
            redirect(route('admin.seo.setting', $id));
        }
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
