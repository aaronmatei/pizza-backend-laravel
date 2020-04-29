<?php

use App\Category;
use App\Ingredient;
use App\Order;
use App\Pizza;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Category::truncate();
        Product::truncate();       
        Ingredient::truncate();
        Order::truncate();
        DB::table('category_product')->truncate();
        DB::table('ingredient_product')->truncate();

        $usersQuantity=500;
        $categoriesQuantity=10;
        $productsQuantity=1000;      
        $ingredientQuantities=10;
        $ordersQuantity=1000;

        factory(User::class, $usersQuantity)->create();
        factory(Ingredient::class, $ingredientQuantities)->create(); 
        factory(Category::class, $categoriesQuantity)->create();
        factory(Product::class, $productsQuantity)->create()->each(
            function($product){
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $ingredients = Ingredient::all()->random(mt_rand(1,5))->pluck('id');               
                $product->categories()->attach($categories);
                $product->ingredients()->attach($ingredients);
            }
        );            
        
        factory(Order::class, $ordersQuantity)->create();
       
        
    }
}
