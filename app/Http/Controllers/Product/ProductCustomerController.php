<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Product;
use Illuminate\Http\Request;

class ProductCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $customers = $product->orders()
            ->with('customer')
            ->get()
            ->pluck('customer')
            ->unique('id')
            ->values();
        return $this->showAll($customers);
    }

}
