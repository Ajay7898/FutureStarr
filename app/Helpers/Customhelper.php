<?php
use App\User;
use App\Models\SocialBuzzAwards;
use App\Models\TalentRatings;
use App\Models\TalentAwards;
use App\Models\Talents;
use App\Models\PurchasedProduct;
use App\Models\CommercialAdViews;
use App\Models\Plans;
use App\Models\Tag;
use App\Models\SellerPlans;
use App\Models\TalentCatagory;
use App\Models\SocialBuzzRiders;
use App\Models\UsersRoles;
use App\Models\ProfileVisitor;
use App\Models\Fanbase;
use App\Models\BuyerProducts;
use App\Models\FavrioteUser;
use App\Models\Setting;
use DateTime as DateTime;
use Auth as Auth;
use Carbon\Carbon;

/**
 * change plain number to formatted currency
 *
 * @param $number
 * @param $currency
 */
function getUserName($userId) 
{
    if (!empty($userId)) 
    {
        $userData = User::find($userId);
        if (!empty($userData)) 
        {
            $name = $userData['first_name'] . ' ' . $userData['last_name'];
        } 
        else 
        {
            $name = '';
        }
        return $name;
    }
}

function getTalentRating($talentId) 
{
    if (!empty($talentId)) 
    {
        $getRatings = DB::table('talent_ratings')->select(DB::raw('count(talent_ratings.user_id) AS users'), DB::raw('sum(talent_ratings.rating) AS rating'))->where('talent_ratings.talent_id', '=', $talentId)->get();
        foreach ($getRatings as $getrating) {
            $total_ratings = $getrating->rating;
            $total_users = $getrating->users;
            if ($total_ratings != 0 || $total_users != 0) 
            {
                $avg_rating = $total_ratings / $total_users;
                if ($avg_rating > 5) 
                {
                    $avg_rating = 5;
                    $rating = $avg_rating;
                } 
                else 
                {
                    $avg_rating = round($total_ratings / $total_users);
                    $rating = $avg_rating;
                }
            } 
            else 
            {
                $rating = '0';
            }
        }
        return $rating;
    }
}

function getUserprofile($userId) 
{
    if (!empty($userId)) 
    {
        $userData = User::find($userId);
        if (!empty($userData)) 
        {
            $profile_pic = $userData['profile_pic'];
        } 
        else 
        {
            $profile_pic = '';
        }
        return $profile_pic;
    }
}

function getTalentRatingByBuyer($talentId, $buyerId) 
{
    if (!empty($talentId) && !empty($buyerId)) 
    {
        $condition = ['talent_id' => $talentId, 'user_id' => $buyerId];
        $rating = TalentRatings::where($condition)->first();
        if (!empty($rating)) {
            $rating = $rating['rating'];
        } else {
            $rating = '';
        }
        return $rating;
    }
}
function getProductSelletCount($sellerId) {
    if (!empty($sellerId)) {
        $whereArray = ['user_id' => $sellerId, 'active' => 'Active', 'approved' => 1];
        $count = Talents::where($whereArray)->get()->count();
        return $count;
    }
}

function getSellerTalentAward($sellerId) {
    if (!empty($sellerId)) {
        $talentCondition = ['user_id' => $sellerId, 'active' => 'Active'];
        $talents = Talents::where($talentCondition)->get();
        $talentIdsArray = [];
        $talendAwardUsers = [];
        foreach ($talents as $key => $value) {
            array_push($talentIdsArray, $value->id);
        }
        $talendAwardUsers = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->get()->count();
        return $talendAwardUsers;
    } else {
        return 0;
    }
}

function getSellerTalentAwardPopUpModal($sellerId) {
    if (!empty($sellerId)) {
        $talentCondition = ['user_id' => $sellerId, 'active' => 'Active'];
        $talents = Talents::where($talentCondition)->get();
        $talentIdsArray = [];
        $talendAwardUsers = [];
        foreach ($talents as $key => $value) {
            array_push($talentIdsArray, $value->id);
        }
        $talendAwardUsers = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->get();
        return $talendAwardUsers;
    } else {
        return false;
    }
}

function cartCount($userId){
    $userId = $userId;
    $condition = [
        'purchased_products.user_id' => $userId, 
        'purchased_products.delete_flag'=>0,
        'talents.active'=>'Active',
        'purchased_products.purchased'  =>  null,
    ];
    $cartCount = DB::table('purchased_products')->join('talents','purchased_products.talent_id', '=', 'talents.id')->where($condition)->count();
    return $cartCount;
}

function getAds($category_id){
    $today = date("Y-m-d h:i:s");
    $ads = DB::table('commercial_ads')
            ->select('commercial_ads.id AS ad_id', 'commercial_ads.*', 'seller_plans.*')
            ->join('seller_plans', 'commercial_ads.seller_plan_id', '=', 'seller_plans.id')
            ->join('talents', 'commercial_ads.product_id', '=', 'talents.id')
            ->where('talents.talent_category_id', '=', $category_id)
            ->where('ad_status', '=', '1')
            ->where('seller_plans.end_date', '>', $today)
            ->get();
    if(!empty($ads)){
        return $ads->random(min($ads->count(), 5));
    } else  {
        return false;
    }
    
}

function sellerId($talentId) {
    if(!empty($talentId)) {
        $id = Talents::where('id','=',$talentId)->pluck('user_id')->first();
        return $id;
    }
}

function getAllUser($current_id) {
    $allUsers = DB::table('chats')
            ->select("*")
            ->where('sent_by', '=', $current_id)
            ->orWhere('received_by', '=', $current_id)
            ->orderBy('last_activity', 'desc')
            ->count();
    return $allUsers;
}

function getInboxUser($current_id) {
    $allUsers = DB::table('chats')
            ->select("*")
            //->where('sent_by', '=', $current_id)
            ->where('received_by', '=', $current_id)
            ->orderBy('last_activity', 'desc')
            ->count();
    return $allUsers;
}

function getAllUserInbox($current_id) {
    $allUsers = DB::table('chats')
            ->select("*")
            ->join('users' , 'users.id' ,'=', 'chats.received_by')
            ->where('sent_by', '=', $current_id)
            ->orWhere('received_by', '=', $current_id)
            ->orderBy('last_activity', 'desc')
            ->get();
    return $allUsers;
}

function buyerTotalPurchase($userId) {
    $purchases = PurchasedProduct::where('user_id','=',$userId)->sum('total_amount');
    return $purchases;
}

function buyerPurchased($userId) {
    $purchases = PurchasedProduct::where('user_id','=',$userId)->count();
    return $purchases;
}


function planName($planId) {
    $planName = Plans::find($planId);
    return $planName['plan_name'];
}

function totalPurchasePerTalent($talentId) {
    if(!empty($talentId)) {
        $count = PurchasedProduct::where('talent_id','=',$talentId)->count();
    } else {
        $count = 0;
    }
    return $count;
}

function blogBy($catId) {
    if(!empty($catId)) {
        $catName = TalentCatagory::find($catId);
        return $catName['name'];
    }
    return false;
}

function promotedAwardCount($talent_id) {
    $count = 0;
    if(!empty($talent_id)){
        $count = TalentAwards::where('talent_id','=',$talent_id)->count();
    } 
    return $count;
}
function userCount() {
    $count = User::where('role_id','!=',1)->count();
    return $count;
}

function tagName($id) {
   $name = Tag::find($id);
   return $name['name'];
}

function riders($userId) {

    if(!empty($userId)) {
        $riders = [];
        $riders = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('following', Auth::user()->id)
               // ->where('follower', '!=' ,Auth::user()->id)
                ->get();

        if(!empty($riders)) {
            return $riders;
        } else {
            return false;
        }
    }
}

function following($userId) {
    if(!empty($userId)) {
        $following = [];
        $following = DB::table('fanbases')
                ->join('users','fanbases.following', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('follower', Auth::user()->id)
               // ->where('following', '!=', Auth::user()->id)
                ->get();

        if(!empty($following)) {
            return $following;
        } else {
            return false;
        }
    }
}

function getSellerSale($sellerId) {
    
    if(!empty($sellerId)) {
        $condition = ['user_id' => $sellerId];
        $sellerTalent = BuyerProducts::where($condition)->count();
        return $sellerTalent;
    }
    return false;
}

function profileViews($user_id) {

    if(!empty($user_id)) {
        $condition = ['profile_id' => $user_id];
        $count = ProfileVisitor::where($condition)->count();
        return $count;
    }
    return false;
}

function users_chat() {

         $users = [];
         /*$riders = DB::table('fanbases')
                    ->join('users','fanbases.following', '=', 'users.id')
                    ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                    ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users_roles.name as role', 'users_roles.id as role_id')
                    ->where('follower', Auth::user()->id)
                    ->where('following','!=' ,Auth::user()->id)
                    ->get()->toArray();*/
         
         $following = DB::table('fanbases')
                    ->join('users','fanbases.follower', '=', 'users.id')
                    ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                    ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
                    ->where('following', Auth::user()->id)
                    ->where('follower','!=' ,Auth::user()->id)
                    ->get()->toArray();
         
        // $favourite_users = FavrioteUser::where('user_id', Auth::user()->id)->get()->toArray();
        //$users = array_merge($riders, $following);
         $users = $following;
         return $users; 
}

function dailySales() {
    
    $talendIdArray = [];
    $today = Carbon::now()->format('Y-m-d');
    $condition = ['user_id' => Auth::user()->id ];
        $sellerTalent = BuyerProducts::where($condition)->get();
        if (!empty($sellerTalent)) {
            foreach ($sellerTalent as $key => $value) {
                $talentId = $value->talent_id;
                array_push($talendIdArray, $talentId);
        }
    }
    $whereCondition = ['date' => $today, 'active' => 1, 'user_id' => Auth::user()->id];
    $dailySales = BuyerProducts::with('getTalent')->whereIn('talent_id', $talendIdArray)->where($whereCondition)->count();
    return $dailySales;
}

function site_config() {

    $site_config = [];
    $site_config = Setting::find(1);
    return $site_config;
}