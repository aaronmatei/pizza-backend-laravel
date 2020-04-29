<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoryCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $customers = $category->products()
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
