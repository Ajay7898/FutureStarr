<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoteProducts extends Model
{
    protected $fillable = ['user_id','talent_id', 'social_id', 'title', 'message', 'active', 'date'];

	public function getCommercila() {
	       return $this->belongsTo(CommercialMedia::class, 'id','talent_id');
	}
	public function getSampleMedia() {
	       return $this->belongsTo(SampleMedia::class, 'id', 'talent_id');
	}
	public function getProductMedia() {
	       return $this->belongsTo(ProductMedia::class, 'id', 'talent_id');
	}
	public function getTalentAwards() {
	      return $this->belongsTo(TalentAwards::class, 'id', 'talent_id');
	}
	public function getTalent() {
	      return $this->belongsTo(Talents::class, 'talent_id');
	}
	
	
	
}
