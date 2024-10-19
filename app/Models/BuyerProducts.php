<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchasedProduct;

class BuyerProducts extends Model
{
  protected $fillable = [
      'user_id','buyer_id','talent_id','active','date', 'created_by', 'updated_by'
  ];

  public function getUserData() {
	     return $this->belongsTo('App\User', 'user_id','id');
  }
  public function getTalent() {
	     return $this->belongsTo(Talents::class, 'talent_id');
  }
  public function getTalentRatings() {
       return $this->belongsTo(TalentRatings::class, 'talent_id', 'talent_id');
  }
  public function getSellerUserInformation() {
	     return $this->belongsTo(User::class, 'user_id', 'id');
  }
  public function getCommercila() {
	     return $this->belongsTo(CommercialMedia::class, 'talent_id','talent_id');
  }
  public function getSampleMedia() {
	     return $this->belongsTo(SampleMedia::class, 'talent_id', 'talent_id');
  }
  public function getProductMedia() {
	     return $this->belongsTo(ProductMedia::class, 'talent_id', 'talent_id');
  }  

  public function getPurchasedProduct() {
       return $this->belongsTo(PurchasedProduct::class, 'pp_id', 'id');
  }  
 
  
}
