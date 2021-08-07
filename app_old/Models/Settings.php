<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Settings extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table    = 'settings';
    protected $primaryKey = 'setting_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'setting_id','terms_condition','about_us','privacy','contact_no','contact_email','contact_name','aleternate_no','contact_address','created_at','updated_at' 
    ];
   
}
