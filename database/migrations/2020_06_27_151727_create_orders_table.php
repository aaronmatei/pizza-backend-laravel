<?php

use App\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quantity');
            $table->bigInteger('customer_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();           
            $table->string('paid')->default(Order::UNPAID_ORDER);
            $table->string('processed')->default(Order::UNPROCESSED_ORDER);
            $table->string('delivered')->default(Order::UNDELIVERED_ORDER);
            $table->date('date_placed')->nullable();
            $table->date('date_delivered')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
