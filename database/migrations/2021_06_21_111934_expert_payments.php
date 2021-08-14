<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExpertPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_payments', function (Blueprint $table) {
            $table->increments('expert_payment_id'); 
            $table->integer('user_id')->nullable();   
            $table->string('transaction_id','50')->nullable(); 
            $table->string('transaction_date','10')->nullable(); 
            $table->string('amount','10')->nullable(); 
            $table->integer('payment_mode')->nullable(); 
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
