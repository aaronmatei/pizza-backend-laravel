<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// users

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//customers
Route::resource("customers","Customer\CustomerController",["only" => ["index","show"]]);
Route::resource("customers.orders", "Customer\CustomerOrderController", ["only" => ["index"]]);
Route::resource("customers.products", "Customer\CustomerProductController", ["only" => ["index"]]);
Route::resource("customers.sellers", "Customer\CustomerSellerController", ["only" => ["index"]]);
Route::resource("customers.categories", "Customer\CustomerCategoryController", ["only" => ["index"]]);
//sellers
Route::resource("sellers","Seller\SellerController",["only" => ["index","show"]]);
//orders
Route::resource("orders","Order\OrderController",["only" => ["index","show"]]);
Route::resource("orders.categories", "Order\OrderCategoryController", ["only" => ["index"]]);
Route::resource("orders.sellers", "Order\OrderSellerController", ["only" => ["index"]]);
//Categories
Route::resource("categories","Category\CategoryController",["except" => ["create","edit"]]);
//Products
Route::resource("products","Product\ProductController",["only" => ["index","show"]]);
//pizza
Route::resource("pizzas","Pizza\PizzaController",["only" => ["index","show"]]);
//ingredients 
Route::resource("ingredients","Ingredient\IngredientController",["only" => ["index","show"]]);
//Users 
Route::resource("users","User\UserController",["except" => ["create","edit"]]);
