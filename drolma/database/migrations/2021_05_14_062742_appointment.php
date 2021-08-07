<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Appointment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('appointment_id');
            $table->string('name',50)->nullable();
            $table->string('note',250)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('appoinment_no','10')->nullable(); 
            $table->string('plan',50)->nullable();
            $table->integer('designation')->nullable();
            $table->integer('expert')->nullable();
            $table->string('date',20)->nullable();
            $table->string('time',20)->nullable();
            $table->integer('status')->default('105')->nullable();
            $table->integer('payment_mode')->default('103')->nullable(); 
            $table->string('amount',10)->nullable(); 
            $table->string('payment_id',100)->nullable();  
            $table->string('amount_refund',10)->nullable(); 
            $table->string('refund_id',100)->nullable(); 
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
         Schema::drop("appointment");
    }
}
