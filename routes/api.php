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
Route::resource("sellers.orders", "Seller\SellerOrderController", ["only" => ["index"]]);
Route::resource("sellers.categories", "Seller\SellerCategoryController", ["only" => ["index"]]);
Route::resource("sellers.customers", "Seller\SellerCustomerController", ["only" => ["index"]]);
Route::resource("sellers.products", "Seller\SellerProductController", ["except" => ["create","show","edit"]]);
//orders
Route::resource("orders","Order\OrderController",["only" => ["index","show"]]);
Route::resource("orders.categories", "Order\OrderCategoryController", ["only" => ["index"]]);
Route::resource("orders.sellers", "Order\OrderSellerController", ["only" => ["index"]]);
//Categories
Route::resource("categories","Category\CategoryController",["except" => ["create","edit"]]);
Route::resource("categories.products", "Category\CategoryProductController", ["only" => ["index"]]);
Route::resource("categories.sellers", "Category\CategorySellerController", ["only" => ["index"]]);
Route::resource("categories.orders", "Category\CategoryOrderController", ["only" => ["index"]]);
Route::resource("categories.customers", "Category\CategoryCustomerController", ["only" => ["index"]]);
//Products
Route::resource("products","Product\ProductController",["only" => ["index","show"]]);
Route::resource("products.orders", "Product\ProductOrderController", ["only" => ["index"]]);
Route::resource("products.customers", "Product\ProductCustomerController", ["only" => ["index"]]);
Route::resource("products.categories", "Product\ProductCategoryController", ["only" => ["index","update","destroy"]]);
Route::resource("products.ingredients", "Product\ProductIngredientController", ["only" => ["index","update","destroy"]]);
Route::resource("products.customers.orders", "Product\ProductCustomerOrderController", ["only" => ["store"]]);
//ingredients 
Route::resource("ingredients","Ingredient\IngredientController",["except" => ["create", "edit"]]);
Route::resource("ingredients.products", "Ingredient\IngredientProductController", ["only" => ["index"]]);
Route::resource("ingredients.sellers", "Ingredient\IngredientSellerController", ["only" => ["index"]]);
Route::resource("ingredients.orders", "Ingredient\IngredientOrderController", ["only" => ["index"]]);
Route::resource("ingredients.customers", "Ingredient\IngredientCustomerController", ["only" => ["index"]]);
//Users 
Route::resource("users","User\UserController",["except" => ["create","edit"]]);
