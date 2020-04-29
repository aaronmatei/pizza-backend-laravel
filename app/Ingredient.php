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
                
    ];
    protected $hidden = [
        'pivot'
    ];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
