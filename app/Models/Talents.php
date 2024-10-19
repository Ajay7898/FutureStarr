<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Talents extends Model
{
    

  public function user() {
		return $this->belongsTo('App\User','user_id');
  }
 
  public function commercialMedia() {
		return $this->hasMany(CommercialMedia::Class,'talent_id');
  }
  public function getCommercila() {
    return $this->belongsTo(CommercialMedia::Class,'id','talent_id');
  }

  public function sampleMedia() {
	      	return $this->hasMany(SampleMedia::Class,'talent_id');
  }

  public function getSampleMedia() {
         return $this->belongsTo(SampleMedia::Class,'id','talent_id');
  }

  public function getProductMedia() {
         return $this->belongsTo(ProductMedia::Class,'id', 'talent_id');
  }

  public function productMedia() {
          return $this->hasMany(ProductMedia::Class,'talent_id');
  }

  public function talentComments() {
          return $this->hasMany(TalentComments::class, 'talent_id', 'id')->with('commentBy');
  }

  public function getTalentCategories() {
           return $this->belongsTo(TalentCatagory::Class,'talent_category_id','id');
  }

  public function getUserData() {
       return $this->belongsTo('App\User', 'user_id','id');
  }
  
  public function getTalentAwards() {
      return $this->hasMany(TalentAwards::class, 'talent_id', 'id')->with('awardBy');
  }

  public function getTalentRiders() {
      return $this->hasMany(TalentRiders::class, 'talent_id')->With('rideBy');
  }
  
  public function getDownloads() {
      return $this->hasMany(BuyerProducts::class, 'talent_id','id');
  }
  public function alreadyAwarded() {
         if(Auth::check()==true) {
           return $this->hasMany('App\Models\TalentAwards','talent_id', 'id')->where('user_id','=', Auth::user()->id);
         } else {
           return $this->hasMany('App\Models\TalentAwards','talent_id', 'id')->where('user_id','=', '');
         }
    } 
  public function selfRider() {
         if(Auth::check()==true) {
           return $this->hasMany('App\Models\TalentRiders','talent_id', 'id')->where('user_id','=', Auth::user()->id);
         } else {
             return $this->hasMany('App\Models\TalentRiders','talent_id', 'id')->where('user_id','=', '');
         }
    }
}
