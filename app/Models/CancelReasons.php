<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class CancelReasons extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'cancel_reasons';
    protected $primaryKey = 'cancel_reasons_id ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cancel_reasons_detail','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
  

   
    
}
