<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->binary('terms_condition')->nullable();
            $table->binary('about_us')->nullable();
            $table->binary('privacy')->nullable();              
            $table->string('contact_no',20)->nullable();
            $table->string('contact_email',50)->nullable();
            $table->string('contact_name',50)->nullable();
            $table->string('aleternate_no',20)->nullable();
            $table->text('contact_address')->nullable(); 
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
        Schema::drop("settings");
    }
}
