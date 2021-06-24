<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class Appointment extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'appointment';
    protected $primaryKey = 'appointment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_id','plan','note','appoinment_no','designation','payment_id','refund_id','amount_refund','expert','date','payment_mode','amount','time','status',
    ];
 
    protected $dates = [ 'deleted_at' ];

    public function expertUsers()
    {
        return $this->hasOne('App\Models\User','user_id','expert');
    }

    public function users()
    {
        return $this->hasOne('App\Models\User','user_id','user_id');
    }

    public function designations()
    {
        return $this->hasOne('App\Models\Designation','designation_id','designation');
    }

    public function appoinment_list($user_id,$from_date,$payment_type,$to_date,$type)
    { 
        $appoinment_data      = Appointment::with('expertUsers','designations')
        ->Where(function($query) use ($from_date,$to_date,$type,$payment_type) {
            if (isset($from_date) && !empty($from_date)) { 
                $query->where('date','>=',$from_date);
            } 
            if (isset($to_date) && !empty($to_date)) { 
                $query->where('date','<=',$to_date);                 
            } 
            if (isset($payment_type) && !empty($payment_type)) { 
                $query->where('payment_mode',$payment_type);                 
            } 
            if (isset($type) && !empty($type)) { 
                if($type == 'current'){
                    $query->where('status',config('constant.STATUS.PENDING'))
                    ->orWhere('status',config('constant.STATUS.ACCEPTED'));  
                }else if($type == 'previous'){
                    $query->where('status',config('constant.STATUS.REJECTED'))
                    ->orWhere('status',config('constant.STATUS.COMPLETED'))
                    ->orWhere('status',config('constant.STATUS.CANCELLED')); 
                }else{
                    $query->where('status',config('constant.STATUS.PENDING'))
                    ->orWhere('status',config('constant.STATUS.ACCEPTED'));  
                }            
            } else{
                $query->where('status',config('constant.STATUS.PENDING'))
                ->orWhere('status',config('constant.STATUS.ACCEPTED'));  
            }
        })->orderBy('appointment_id','desc')->Where('user_id',$user_id)->paginate(15);
        return $appoinment_data;
    }

    public function expert_appoinment_list($user_id,$from_date,$payment_type,$to_date,$type)
    { 
        $appoinment_data      = Appointment::with('users','designations')
        ->Where(function($query) use ($from_date,$to_date,$type,$payment_type) {
            if (isset($from_date) && !empty($from_date)) { 
                $query->where('date','>=',$from_date);
            } 
            if (isset($to_date) && !empty($to_date)) { 
                $query->where('date','<=',$to_date);                 
            } 
            if (isset($payment_type) && !empty($payment_type)) { 
                $query->where('payment_mode',$payment_type);                 
            } 
            if (isset($type) && !empty($type)) { 
                if($type == 'current'){
                    $query->where('status',config('constant.STATUS.PENDING'))
                    ->orWhere('status',config('constant.STATUS.ACCEPTED'));  
                }else if($type == 'previous'){
                    $query->where('status',config('constant.STATUS.REJECTED'))
                    ->orWhere('status',config('constant.STATUS.COMPLETED'))
                    ->orWhere('status',config('constant.STATUS.CANCELLED')); 
                }else{
                    $query->where('status',config('constant.STATUS.PENDING'))
                    ->orWhere('status',config('constant.STATUS.ACCEPTED'));  
                }            
            } else{
                $query->where('status',config('constant.STATUS.PENDING'))
                ->orWhere('status',config('constant.STATUS.ACCEPTED'));  
            }
        })->Where('expert',$user_id)
        ->orderBy('appointment_id','desc')->paginate(15);
        return $appoinment_data;
    }

    public function admin_appoinment_list($userid = '')
    { 
        $appoinment_data      = Appointment::with('users','expertUsers','designations')
        ->Where(function($query) use ($userid) {
            if (isset($userid) && !empty($userid)) { 
                $query->where('expert',$userid);
            }   
        })
        ->orderBy('appointment_id','desc')->paginate(15);
        return $appoinment_data;
    }

    public function appoinment_list_trans($userType)
    { 
        $appoinment_trans_data = Appointment::with('expertUsers')->select('expert','appointment_id','name','appoinment_no','plan','date','time','status','payment_mode','amount','payment_id','refund_id','amount_refund')->orderBy('appointment_id','desc')
        ->Where(function($query) use ($userType) {
            if (isset($userType) && $userType == 'user') { 
                $query->where('user_id',Session::get('user_id'));
            }  
            if (isset($userType) && $userType == 'expert') { 
                $query->where('expert',Session::get('user_id'));
            }  
        })->paginate(15);
        return $appoinment_trans_data;
    }
}
