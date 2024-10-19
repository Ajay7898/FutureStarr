<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = [];
        $users = User::with('getUserRole')->where('role_id', '!=', 1)->paginate(10);
        return view( 'admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = [];
        $today = Carbon::now();
        $current_year = $today->year;
        $filter = '';

        if($request->has('filter') && !empty($request->has('filter'))) {
          
           $where_month = $request['filter'] ;
           $filter =  $request['filter'];
           $current_month = $request['month'];
       
        } else {
           
           $where_month = $today->month ;
           $filter =  $request['filter'];
           $current_month = $today->format('F');
        }
         
        $users = User::with('getUserRole')->where('role_id', '!=', 1)->whereMonth('created_at', $where_month)->whereYear('created_at', $today->year)->paginate(10);

        return view( 'admin.users.monthly-signup', compact('users', 'current_month', 'current_year', 'filter'));
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
