<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentDownloads extends Model
{
    protected $fillable = ['talent_id', 'downloaded_by', 'daily_download'];
}
