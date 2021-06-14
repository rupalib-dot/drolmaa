<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('cart_id'); 
            $table->integer('user_id')->nullable(); 
            $table->integer('product_id')->nullable();  
            $table->string('product_name',50)->nullable();
            $table->integer('quantity')->nullable();  
            $table->string('price',200)->nullable();    
            $table->string('total_price',200)->nullable();     
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
