<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\ApiController;
use App\Order;
use Illuminate\Http\Request;

class OrderSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $seller = $order->product->seller;
        return $this->showOne($seller);
        
    }

    
}
