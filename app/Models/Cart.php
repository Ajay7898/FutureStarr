<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\UserAddress;

class Cart extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function cart_products()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function billing_address()
    {
        return $this->hasOne(UserAddress::class, 'id', 'bill_addr_id');
    }

    public function shipping_address()
    {
        return $this->hasOne(UserAddress::class, 'id', 'ship_addr_id');
    }
}
