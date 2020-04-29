<?php

namespace App;

use App\Customer;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    const PAID_ORDER = "1";
    const UNPAID_ORDER = "0";

    const PROCESSED_ORDER = "1";
    const UNPROCESSED_ORDER = "0";

    const DELIVERED_ORDER = "1";
    const UNDELIVERED_ORDER = "0";




    protected $fillable = [
        "quantity",
        "customer_id",
        "product_id",        
        "paid",
        "processed",
        "delivered",
        "date_placed",
        "date_delivered"
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function isPaid(){
        return $this->paid == Order::PAID_ORDER;
    }
    public function isProcessed(){
        return $this->processed == Order::PROCESSED_ORDER;
    }
    public function isDelivered(){
        return $this->delivered == Order::DELIVERED_ORDER;
    }


}
