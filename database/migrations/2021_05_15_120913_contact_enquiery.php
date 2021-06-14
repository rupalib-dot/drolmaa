<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactEnquiery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_enquiery', function (Blueprint $table) {
            $table->increments('enquiery_id');
            $table->string('name',50)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('phone',10)->nullable(); 
            $table->string('email',50)->nullable();
            $table->string('message',255)->nullable(); 
            $table->integer('module_type')->nullable(); 
            $table->integer('module_id')->nullable();
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
         Schema::drop("contact_enquiery");
    }
}
