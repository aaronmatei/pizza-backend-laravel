<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Ingredient;
use App\Product;
use Illuminate\Http\Request;

class ProductIngredientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $ingredients = $product->ingredients;
        return $this->showAll($ingredients);
    }
     
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Ingredient $ingredient)
    {
        //attach ----> adds, but with duplicates 
        //sync ----> adds and detaches others
        //syncWithoutDetaching ---> mantains others
        $product->ingredients()->syncWithoutDetaching([$ingredient->id]);
        return $this->showAll($product->ingredients);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Ingredient $ingredient)
    {
        if (!$product->ingredients()->find($ingredient->id)) {
            return $this->errorResponse('The specified ingredient does not belong to this product', 404);
        }
        $product->ingredients()->detach($ingredient->id);
        return $this->showAll($product->ingredients);
    }

}
