<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = ['user_id', 'transaction_id', 'token', 'PayerID','talent_id','plan_id','amount','description','transaction_payload'];
}
