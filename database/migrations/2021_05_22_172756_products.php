<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id'); 
            $table->string('product_name',50)->nullable(); 
            $table->longText('description')->nullable(); 
            $table->longText('instructions')->nullable(); 
            $table->longText('referenceses')->nullable();  
            $table->integer('category_id')->nullable(); 
            $table->integer('created_by')->nullable(); 
            $table->integer('rating')->nullable();
            $table->integer('quantity')->nullable(); 
            $table->string('selling_price',100)->nullable();
            $table->string('mrp',100)->nullable();
            $table->string('expiry_date',20)->nullable();
            $table->integer('status')->nullable();
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
