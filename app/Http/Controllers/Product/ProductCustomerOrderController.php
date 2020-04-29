<?php

namespace App\Http\Controllers\Product;

use App\Customer;
use App\Http\Controllers\ApiController;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ProductCustomerOrderController extends ApiController
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $customer)
    {
        $rules = [
            'quantity'=>'required|integer|min:1',
        ];
        $this->validate($request, $rules);

        if($customer->id == $product->seller_id)
        {
            return $this->errorResponse('The seller and the buyer must be different',409);
        }
        if(!$customer->isVerified())
        {
            return $this->errorResponse('The customer must be a verified user to make an order',409);
        }
        if (!$product->seller->isVerified()) {
            return $this->errorResponse('The seller must be a verified user to transact', 409);
        }
        if (!$product->isAvailable()) {
            return $this->errorResponse('The product is not available for sale', 409);
        }
        if ($product->quantity < $request->quantity) {
            $available = $product->quantity;            
            return $this->errorResponse('Not enough quantity to sell, only '. $available .' items available', 409);
        }

        return DB::transaction(function() use ($request,$product,$customer){
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Order::create([
                'quantity'=> $request->quantity,
                'customer_id'=>$customer->id,
                'product_id'=>$product->id,                
                'paid'=>Order::UNPAID_ORDER,
                'processed'=>Order::UNPROCESSED_ORDER,
                'delivered'=>Order::UNDELIVERED_ORDER,
                'date_placed'=>Carbon::now(),
                'date_delivered'=>null,
            ]);

            return $this->showOne($transaction,201);

        });
    }

   

    
}
