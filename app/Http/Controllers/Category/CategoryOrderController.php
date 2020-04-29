<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoryOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $orders = $category->products()
            ->whereHas('orders')
            ->with('orders')
            ->get()
            ->pluck('orders')
            ->collapse();
        return $this->showAll($orders);
    }
    
}
