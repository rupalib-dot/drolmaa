<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->increments('Subscription_id'); 
            $table->integer('user_id')->nullable();   
            $table->string('payment_id','50')->nullable(); 
            $table->string('register_amount','10')->nullable(); 
            $table->string('start_date','10')->nullable(); 
            $table->string('end_date','10')->nullable(); 
            $table->integer('payment_mode')->nullable(); 
            $table->integer('month')->nullable(); 
            $table->string('plan_detail','50')->nullable(); 
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
