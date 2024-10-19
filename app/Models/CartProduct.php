<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CartProduct extends Model
{
	protected $table = 'cart_product';
    use HasFactory;

    protected $fillable = ['cart_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function cart_products()
    {
        return $this->hasMany('cart_product');
    }
}
