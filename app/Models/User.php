<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Model
{
    use SoftDeletes;


    protected $table    = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_image',
        'full_name',
        'mobile_number',
        'email_address',
        'user_age',
        'user_gender',
        'country_id',
        'state_id',
        'city_id',
        'address_details',
        'designation_id',
        'office_phone_number',
        'user_experience',
        'special_plan',
        'licance_pic',
        'pan_card_pic',
        'aadhar_card_pic',
        'professional_certificate_pic',
    ];

    public function user_role()
    {
        return $this->hasOne('App\Models\UserRole','user_id');
    }

    public function login_account($email_address, $user_password, &$user_data)
    {
        $user_status    = False;
        $user_data      = User::with('user_role')
        ->Where(function ($query) use ($email_address) {
            $query->where('email_address',$email_address)
                  ->orWhere('mobile_number',$email_address);
        })
        ->where('user_password',$user_password)->first(); 
        if(isset($user_data))
        {
            $user_status = True;
        }
        return $user_status;
    }

    public function pass_exist($user_id, $user_password, &$user_data)
    {
        $user_status    = False;
        $user_data      = User::Where('user_id',$user_id)->Where('user_password',$user_password)->first();
        if(isset($user_data))
        {
            $user_status = True;
        }
        return $user_status;
    }

     public function total_users($user_role)
    { 
        $user_data      = User::select('users.*')->Where('user_role.role_id',$user_role)->join('user_role','user_role.user_id','=','users.user_id')->orderBy('users.user_id','desc')->get(); 
        return $user_data;
    }
 
}
