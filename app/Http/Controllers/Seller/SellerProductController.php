<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Ingredient;
use App\Product;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->showAll($products);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $seller)
    {
        $rules = [
            'name'=>'required|unique:products',
            'description'=>'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',   
            'status'=> 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'size' => 'in:' . Product::PRODUCT_SMALL . ',' . Product::PRODUCT_MEDIUM . ',' . Product::PRODUCT_LARGE . ',' . Product::PRODUCT_X_LARGE,
            'pizza'=> 'in:' . Product::PIZZA_PRODUCT . ',' . Product::NONPIZZA_PRODUCT,         
            'image' => 'required|image',          
           
        ];
        $this->validate($request, $rules);
        $data = $request->all();        
       
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;
        $data['status']=Product::UNAVAILABLE_PRODUCT;

        $product = Product::create($data);
        return $this->showOne($product);        
        
    }
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Product $product)
    {
        $rules = [          
            'quantity' => 'integer|min:1',
            'price' => 'regex:/^\d*(\.\d{2})?$/',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'size' => 'in:' . Product::PRODUCT_SMALL . ',' . Product::PRODUCT_MEDIUM . ',' . Product::PRODUCT_LARGE . ',' . Product::PRODUCT_X_LARGE,
            'pizza' => 'in:' . Product::PIZZA_PRODUCT . ',' . Product::NONPIZZA_PRODUCT,
            'image' => 'image',
        ];

        $this->validate($request, $rules);
        $this->checkSeller($seller, $product);
        $product->fill($request->only([
            'name',
            'description',
            'quantity',
            'price',           
                     
            ]));
        if($request->has('status'))
        {
            $product->status = $request->status;
            if($product->isAvailable() && $product->categories()->count() == 0 )
            {
                return $this->errorResponse('An active product must have atleast one category', 409);

            }
        }
        if ($request->has('pizza')) {
            $product->pizza = $request->pizza;
        }
        if ($request->has('size')) {
            $product->size = $request->size;
        }
        if($request->has('image'))
        {
            Storage::delete($product->image);
            $product->image = $request->image->store('');

        }

        if($product->isClean())
        {
            return $this->errorResponse('Must change at least a value to update', 422);
        }

        $product->save();
        return $this->showOne($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);
        Storage::delete($product->image);
        $product->delete();
        return $this->showOne($product);
        
    }

    protected function checkSeller(Seller $seller, Product $product)
    {
        if($seller->id != $product->seller_id)
        {
            throw new HttpException(422,"specified seller not for that product");

        }
    }
}
