<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupons extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'coupons';
    protected $primaryKey = 'coupon_id ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_id',
        'title',
        'coupon_code',
        'discount',
        'start_date',
        'expiry_date',
        'coupon_image',
        'created_at',
        'updated_at',
    ];

    protected $dates = [ 'deleted_at' ];
  

   
    
}
