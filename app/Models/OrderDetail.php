<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'order_detail';
    protected $primaryKey = 'order_detail_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *  

     */ 

    protected $fillable = [
        'order_id','product_id','product_name','quantity','price','total_price','created_at','updated_at',
    ];
 
    protected $dates = [ 'deleted_at' ];  
}
