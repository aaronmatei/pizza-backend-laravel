<?php

namespace App;

use App\Pizza;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'product_id'        
    ];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
