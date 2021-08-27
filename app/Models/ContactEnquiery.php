<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactEnquiery extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable; 
    protected $table    = 'contact_enquiery';
    protected $primaryKey = 'enquiery_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enquiery_id','name','user_id','topic_id','phone','email','message','module_type','module_id','created_at','updated_at' 
    ];

    protected $dates = [ 'deleted_at' ];
}
