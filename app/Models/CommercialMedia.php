<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommercialMedia extends Model
{
   protected $fillable = ['talent_id', 'image_name', 'image_path']; 

   public function getProductMedia() {

   	  return $this->belongsTo(ProductMedia::class, 'talent_id','talent_id');
   }  
   public function getSampleMedia() {

   	  return $this->belongsTo(SampleMedia::class, 'talent_id','talent_id');
   }
}
