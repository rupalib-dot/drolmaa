<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Authenticatable
{ 
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'workshop';
    protected $primaryKey = 'workshop_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workshop_id','title','designation','expert','date','start_date','price','time','created_at','updated_at'
    ];

    protected $dates = [ 'deleted_at' ];
 
    public function expertUsers()
    {
        return $this->hasOne('App\Models\User','user_id','expert');
    } 

    public function designations()
    {
        return $this->hasOne('App\Models\Designation','designation_id','designation');
    }

    public function workshop_list()
    { 
        $workshop_data      = Workshop::with('expertUsers','designations')->orderBy('workshop_id','desc')->paginate(15);
        return $workshop_data;
    }
    
}
