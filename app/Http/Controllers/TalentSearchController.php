<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Metatags;
use App\Models\Talents;
use App\User;
use Response;

class TalentSearchController extends Controller
{
    /**
     * Display a listing of the search
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request['search'])){
             $talents = [];
             $categories = [];
             $talentList ='';
             $categoryList = '';
             $talentListArr = [];
             $categoryListArr = [];
             $sellers = [];
             
             $searchQuery = $request['search'];
             $condition = ['active' => 'Active' , 'approved'=> 1];
             
             $talents = Talents::where('title', 'like', '%' . $searchQuery . '%')->where($condition)->get();
             $talentCount = count($talents);
             $categories = TalentCatagory::where('name', 'like', '%' . $searchQuery . '%')->get();
             $categoriesCount = count($categories);
             
             $sellerCondition = ['role_id' => 4];
             $sellers = User::where('username', 'like', '%' . $searchQuery . '%')->where($sellerCondition)->get();
             $sellersCount = count($sellers);
            
             $return[] = view('home-search')->with(['talents' => $talents, 'talentCount'=> $talentCount, 'categories'=> $categories, 'categoriescount'=> $categoriesCount, 'sellers' => $sellers , 'sellersCount' => $sellersCount])->render();

            
             return response()->json(['state' => 1, 'searhlist' => $return]);

        }  
    }

}
