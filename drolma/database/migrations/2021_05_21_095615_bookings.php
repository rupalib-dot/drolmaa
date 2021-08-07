<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('booking_id'); 
            $table->integer('user_id')->nullable(); 
            $table->integer('module_id')->nullable(); 
            $table->string('booking_no','10')->nullable();             
            $table->integer('module_type')->nullable(); 
            $table->integer('status')->nullable();
            $table->integer('payment_mode')->default('103')->nullable(); 
            $table->string('payment_id',100)->nullable(); 
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
        Schema::drop("bookings");
    }
}
