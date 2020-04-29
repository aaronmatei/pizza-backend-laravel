<?php

namespace App;

use App\Order;
use App\Scopes\CustomerScope;

class Customer extends User
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CustomerScope);
    }
    
    public function orders(){
        return $this->hasMany(Order::class);

    }
}
