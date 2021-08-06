<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthTips extends Authenticatable
{    
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'health_tips';
    protected $primaryKey = 'health_tips_id ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'health_tips_id','health_tips_desc','health_tips_title','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
  

   
    
}
