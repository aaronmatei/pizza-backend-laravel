<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Ingredient;
use App\Order;
use App\Pizza;
use App\Product;
use App\Seller;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

//user

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,       
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone'=>$faker->phoneNumber,
        'city'=>$faker->city,
        'street'=>$faker->name,
        'address'=>$faker->address,
        'house_number'=>$faker->randomNumber(4),
        'remember_token' => Str::random(10),
        'verified'=> $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token'=> $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
        'admin' => $admin = $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),        
    ];
});

//category
$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
     
    ];
});

//product
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity'=>$faker->numberBetween(1,10),
        'price'=> $faker->numberBetween(50,100),
        'status'=>$faker->randomElement([Product::AVAILABLE_PRODUCT,Product::UNAVAILABLE_PRODUCT]),
        'image'=> $faker->randomElement(['p1.jpg', 'p2.jpg', 'p3.jpg', 'p4.jpg', 'p5.jpg', 'p6.jpg', 'p7.jpg', 'p8.jpg']),
        'seller_id'=> User::all()->random()->id,        
        'size'=>$faker->word,
        'pizza'=>$faker->randomElement([Product::PIZZA_PRODUCT,Product::NONPIZZA_PRODUCT]),
        //same as: User::inRandomOrder()->first()->id

    ];
});

//order
$factory->define(Order::class, function (Faker $faker) {
    $seller = Seller::has('products')->get()->random();
    $customer = User::all()->except($seller->id)->random();
    return [
        'quantity' => $faker->numberBetween(1,3),
        'customer_id' => $customer->id,
        'product_id' => $seller->products->random()->id,
        'total_price' => $faker->numberBetween(500,1000),
        'paid' => $faker->randomElement([Order::PAID_ORDER, Order::UNPAID_ORDER]),
        'processed' => $faker->randomElement([Order::PROCESSED_ORDER, Order::UNPROCESSED_ORDER]),
        'delivered' => $faker->randomElement([Order::DELIVERED_ORDER, Order::UNDELIVERED_ORDER]),
        'date_placed' => $faker->dateTimeBetween('-2 years', 'now','UTC'),
        'date_delivered' => $faker->dateTimeBetween('-1 year', 'now', 'UTC'),        

    ];
});


//ingredient
$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        
    ];
});



