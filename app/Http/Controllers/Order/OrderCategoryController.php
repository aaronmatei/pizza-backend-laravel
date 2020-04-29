<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\ApiController;
use App\Order;
use Illuminate\Http\Request;

class OrderCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $categories = $order->product->categories;
        return $this->showAll($categories);       
        
    }

    
}
