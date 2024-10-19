<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerPlans extends Model
{
    protected $fillable = ['talent_id', 'plan_id', 'user_id', 'start_date', 'end_date', 'created_by','updated_by','expired'];

    public function getPlanDetail() {
    	return $this->belongsTo('App\Models\Plans','plan_id','id');
    }
}
