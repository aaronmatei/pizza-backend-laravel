<?php

namespace App\Http\Controllers\Ingredient;

use App\Http\Controllers\ApiController;
use App\Ingredient;
use Illuminate\Http\Request;

class IngredientProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ingredient $ingredient)
    {
        $products = $ingredient->products;
        return $this->showAll($products);
    }

    
}
