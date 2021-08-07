<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'order';
    protected $primaryKey = 'order_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *  

     */  
           

    protected $fillable = [
        'user_id','full_name','user_gender','company_name','refund_id','refund_status','refund_amount','order_status','address1','address2','country_id','state_id','city_id','pincode','mobile_number','email_address','grand_total','order_no','payment_id','payment_type','payment_status','created_at','updated_at',
    ];
 
    protected $dates = [ 'deleted_at' ];  
}
