<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory;


    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function media()
    {
        return $this->hasMany(ProductImage::class);
    }
}
