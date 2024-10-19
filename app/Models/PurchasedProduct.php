<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
  protected $fillable = [
      'id','user_id','cart_id','talent_id','title','quantity','total_amount','created_by','updated_by'
  ];

  public function getTalent() {
  	return $this->belongsTo('App\Models\Talents','talent_id','id')->where('active','=','Active');
  }

  public function getCommercial() {
  	return $this->belongsTo('App\Models\CommercialMedia','talent_id','talent_id');
  }

  public function getSampleMedia() {
  	return $this->belongsTo('App\Models\SampleMedia','talent_id','id');
  }

  public function getSellerDetail() {
    return $this->belongsTo('App\User','user_id','id');
  }

}


