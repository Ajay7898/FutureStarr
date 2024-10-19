<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerStripeAccounts extends Model
{
    protected $fillable = ['user_id', 'account_id', 'token_type', 'scope'];
}

