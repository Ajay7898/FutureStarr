<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Metatags;
use App\Models\Talents;
use Response;

class SearchController extends Controller
{
    /**
     * Display a listing of the search
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug ='' ,Request $request)
    { 
        if($request->ajax()){
                
                $catagories = TalentCatagory::where('id', '>', $slug)->take(6)->get();
                $event = $request->event;

                if(!empty($catagories)){
                   
                    $return[] = view('frontend.search.search-ajax')->with(['categories' => $catagories, 'event' => $event])->render();
                    return response()->json(['state' => 1, 'messages' => $return]); 
                }
               
        } else {

            if(empty($slug)) {

                 $catagories = TalentCatagory::paginate(6);
                 $metaTags =  Metatags::where('page_title','=','Starr Search')->first();
                 return view('frontend.search.index',compact('catagories','metaTags'));

            } else {

                 $catagory = TalentCatagory::where('slug','=',$slug)->first();
                 if(!empty($catagory)) {
						
                         $metaTags = [];
                         $metaTags = [ 
                              'title' => $catagory['meta_title'], 
                              'description' => $catagory['meta_description'], 
                              'keywords' => $catagory['meta_keywords'],
                              'og_image' => env('APP_URL') .'/'. $catagory['catagory_banner']
                          ];
						
						/*$whereArr = ['type' => 'star_search_category', 'page_title' => $catagory['name']];
						$metaTags = Metatags::where($whereArr)->first();*/
						
						return view('frontend.search.info',compact('catagory','metaTags'));
                 } else {
                     
                     return redirect( route('search.index') );
                 }   
            }
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
        $catagory = TalentCatagory::find($id);
        $whereArr =  ['type'=>'Categories','page_title'=> $catagory['name']];
        $metaTags =  Metatags::where($whereArr)->first();
        dd($metaTags);
        return view('frontend.search.info',compact('catagory','metaTags'));
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
