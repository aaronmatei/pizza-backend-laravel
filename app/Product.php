<?php

namespace App;

use App\Category;
use App\Seller;
use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Product extends Model
{
    const AVAILABLE_PRODUCT="available";
    const UNAVAILABLE_PRODUCT="unavailable";
    const PIZZA_PRODUCT = "true";
    const NONPIZZA_PRODUCT = "false";  

    const PRODUCT_SMALL = 'small';
    const PRODUCT_MEDIUM = 'medium';
    const PRODUCT_LARGE = 'large';
    const PRODUCT_X_LARGE = 'x-large';
   

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "name",
        "description",
        "quantity",
        "price",
        "size",
        "status",
        "image",
        "seller_id",       
        "pizza",

    ];
    protected $hidden = [
        'pivot'
    ];

    public function isSmall()
    {
        return $this->size == Product::PRODUCT_SMALL;
    }
    public function isMedium()
    {
        return $this->size == Product::PRODUCT_MEDIUM;
    }
    public function isLarge()
    {
        return $this->size == Product::PRODUCT_LARGE;
    }
    public function isXLarge()
    {
        return $this->size == Product::PRODUCT_X_LARGE;
    }
   

    public function isAvailable()
    {
        return $this->status == Product::AVAILABLE_PRODUCT;
    }
  
    public function isPizza()
    {
        return $this->pizza == Product::PIZZA_PRODUCT;
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
}
