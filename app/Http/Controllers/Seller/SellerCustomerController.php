<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;

class SellerCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $customers = $seller->products()
            ->whereHas('orders')
            ->with('orders.customer')
            ->get()
            ->pluck('orders')
            ->collapse()
            ->pluck('customer')
            ->unique('id')
            ->values();
        return $this->showAll($customers);
    }

}
