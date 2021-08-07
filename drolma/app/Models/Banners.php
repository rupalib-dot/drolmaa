<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Banners extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'banner';
    protected $primaryKey = 'banner_id ';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_id','description','banner_image','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
  

   
    
}