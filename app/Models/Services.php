<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'services';
    protected $primaryKey = 'services_id  ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'services_id','services_title','services_detail','services_photo','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
  

   
    
}
