<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_image',100)->nullable();
            $table->string('full_name',30)->nullable();
            $table->string('mobile_number',10);
            $table->string('email_address',50)->nullable();
            $table->string('user_age',3)->nullable();
            $table->string('user_gender',3)->nullable();
            $table->string('country_id',4)->nullable();
            $table->string('state_id',4)->nullable();
            $table->string('city_id',4);
            $table->date('user_dob')->nullable();
            $table->string('address_details',150)->nullable();
            $table->string('designation_id',4)->nullable();
            $table->string('office_phone_number',10)->nullable();
            $table->string('user_experience',2)->nullable();
            $table->string('special_plan',10)->nullable();
            $table->string('licance_pic')->nullable();
            $table->string('pan_card_pic')->nullable();
            $table->string('aadhar_card_pic')->nullable();
            $table->string('professional_certificate_pic')->nullable();
            $table->string('user_password')->nullable();
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
        Schema::drop("users");
    }
}
