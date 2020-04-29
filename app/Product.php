<?php

namespace App;

use App\Category;
use App\Seller;
use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    const AVAILABLE_PRODUCT="available";
    const UNAVAILABLE_PRODUCT="unavailable";
    const PIZZA_PRODUCT = "true";
    const NONPIZZA_PRODUCT = "false";

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
        "ingredient_id",
        "pizza",

    ];

    public function isAvailable(){
        return $this->status == Product::AVAILABLE_PRODUCT;
    }
    public function isPizza(){
        return $this->pizza == Product::PIZZA_PRODUCT;
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class);
    }
}
