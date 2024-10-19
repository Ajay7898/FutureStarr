<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TalentCatagory;
use App\Models\Talents;
use Response;
use Carbon\Carbon;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $talents = [];
         $today = Carbon::now();
         $current_year = $today->year;
         $current_month = $today->month;
         $filter = '';

         if($request->has('filter') && !empty($request->has('filter'))) {
          
           $where_month = $request['filter'] ;
           $filter =  $request['filter'];
           $current_month = $request['month'];

           $talents = Talents::with(['user' , 'getTalentCategories' ])->whereMonth('created_at', $where_month)->whereYear('created_at', $today->year)->paginate(10);

        } else {
           $talents  = Talents::with(['user' , 'getTalentCategories' ])->paginate(10);
        }

        return view( 'admin.pages.approve-disapprove' , compact('talents', 'current_year', 'current_month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->ajax()) {

            if($request->status == 1)
            {
                $statusvalue = Talents::Where('id',$request->talant_id)
                        ->update([
                            'approved' => 1
                        ]);
                return $statusvalue;
            }
            if($request->status == 0)
            {
                $statusvalue = Talents::where('id',$request->talant_id)
                        ->update([
                            'approved' => 0
                        ]);
                return $statusvalue;
            }
             
             // $where_condition = ['id' => $request['value1'] ];
             // $table_array = ['approved' => $request['value2'] ];
             // $approved_disapproved = Talents::where($where_condition)->update($table_array);
             // if(!empty($approved_disapproved) ) {

             //       $response = ['error' => 'Product status updated successfully!'];
             //       return Response::json($response);

             // } else {

             //     $response = ['error' => 'Technical error.'];
             //     return Response::json($response);
             // }
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
        if(!empty($id)) {

            $deleted = Talents::destroy($id);
            if(!empty($deleted) ) {

                   $response = ['success' => 'Product deleted successfully!'];
                   return Response::json($response);

             } else {
                   $response = ['error' => 'Technical error.'];
                   return Response::json($response);
             }
        }
    }

    /**
     * Remove the specified bulk resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
        if($request->ajax()) {
         
            $blogId =  $request['ids'];
            $deleted = Talents::WhereIn('id', $blogId)->delete();
             if (!empty($deleted)) {
                $response = ['success' => 'Deleted successfully.'];
                return Response::json($response);
            } else {
                $response = ['error' => 'Unable to delete the records.'];
                return Response::json($response);
            }

         } else {

            $response = ['error' => 'No direct script access allowed.'];
            return Response::json($response);
         }
    }
}
