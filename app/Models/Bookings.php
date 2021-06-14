<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookings extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'bookings';
    protected $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id','user_id','module_id','booking_no','module_type','status','payment_mode','payment_id','created_at','updated_at',
    ];
 
    protected $dates = [ 'deleted_at' ];

    public function workshop()
    {
        return $this->hasOne('App\Models\Workshop','workshop_id','module_id');
    }
    
    public function Users()
    {
        return $this->hasOne('App\Models\User','user_id','user_id');
    }

    public function booking_list($user_id,$from_date,$to_date)
    { 
        $booking_data      = Bookings::select('bookings.*','workshop.workshop_id','workshop.title','workshop.designation','workshop.expert','workshop.date','workshop.price','workshop.time')
        ->join('workshop','workshop.workshop_id','=','bookings.module_id')
        ->Where('bookings.user_id',$user_id)
        ->Where(function($query) use ($from_date,$to_date) {
            if (isset($from_date) && !empty($from_date)) { 
                $query->where('workshop.date','>=',$from_date);
            } 
            if (isset($to_date) && !empty($to_date)) { 
                $query->where('workshop.date','<=',$to_date);                 
            }  
        })
        ->paginate(15);
        return $booking_data;
    }

    public function UsersBookedWorkshop($module_id)
    { 
        $user_Booked_workshop  = Bookings::with('Users')->Where('module_id',$module_id)->orderBy('workshop_id','desc')->paginate(15);
        return $user_Booked_workshop;
    }
      
}
