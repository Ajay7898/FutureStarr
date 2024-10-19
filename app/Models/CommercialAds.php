<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommercialAds extends Model
{
   protected $fillable = ['seller_plan_id', 'user_id', 'description', 'video_name', 'video_path', 'product_id', 'product_url', 'ad_status', 'created_by', 'updated_by'];   

    public function getAllPlan() {
         return $this->belongsTo('App\Models\Plans', 'plan_id', 'id');
    }
    public function getSellerPlan(){
         return $this->belongsTo('App\Models\SellerPlans', 'seller_plan_id', 'id');
    }
    public function getAdsViews() {
           return $this->hasMany('App\Models\CommercialAdViews', 'id', 'id');
    } 
    public function getPlanDetail() {
        return $this->belongsTo('App\Models\Plans','seller_plan_id','id');
    }
    public function adViews() {
        return $this->hasMany('App\Models\CommercialAdViews','ad_id','id');
    }
    public function getTalents() {
        return $this->belongsTo('App\Models\Talents','product_id','id');
    }
}
