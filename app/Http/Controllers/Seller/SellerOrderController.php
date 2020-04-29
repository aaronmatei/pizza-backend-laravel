<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;

class SellerOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $orders = $seller->products()
            ->whereHas('orders')
            ->with('orders')
            ->get()
            ->pluck('orders')
            ->collapse();
        return $this->showAll($orders);
    }

    
}
