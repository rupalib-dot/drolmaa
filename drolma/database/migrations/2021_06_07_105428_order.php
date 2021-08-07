<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create('order', function (Blueprint $table) {
            $table->increments('order_id'); 
            $table->integer('user_id')->nullable();  
            $table->string('full_name','50')->nullable();
            $table->integer('user_gender')->nullable(); 
            $table->string('company_name','50')->nullable();
            $table->string('address1','50')->nullable();
            $table->string('address2','50')->nullable();
            $table->integer('country_id')->nullable(); 
            $table->integer('state_id')->nullable(); 
            $table->integer('city_id')->nullable();
            $table->integer('pincode')->nullable();
            $table->string('mobile_number','13')->nullable();
            $table->string('email_address','50')->nullable(); 
            $table->string('grand_total','200')->nullable();
            $table->string('order_no','10')->nullable();
            $table->string('payment_id','50')->nullable();
            $table->integer('payment_type')->nullable();
            $table->string('payment_status','20')->nullable();
            $table->string('refund_id','50')->nullable();
            $table->string('refund_status','20')->nullable();
            $table->string('refund_amount','10')->nullable();
            $table->integer('order_status')->nullable();
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
