<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;

class Feedback extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'feedback';
    protected $primaryKey = 'feedback_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feedback_id','feedback_by','feedback_to','rating','message','module_type','module_id','created_at','updated_at',
    ];

    protected $dates = [ 'deleted_at' ];

    public function feedbackTo_users()
    {
        return $this->hasOne('App\Models\User','user_id','feedback_by');
    }

    public function feedbackBy_users()
    {
        return $this->hasOne('App\Models\User','user_id','feedback_by');
    }

    public function feedback_list($module_id,$feedback_by,$feedback_to,$module_type)
    {  
        $feedback_data['feedbackTo'] = array();
        $feedback_data['feedbackBy'] = array();

        if(!isset($feedback_by) && empty($feedback_by)){
            $feedback_by = Session::get('user_id');
        }
        
        if(isset($module_type) && $module_type != ''){
            $feedback_data['feedbackBy']   = Feedback::with('feedbackTo_users')
            ->Where(function($query) use ($module_id,$feedback_by,$feedback_to,$module_type) {
                if (isset($module_id) && !empty($module_id)) { 
                    $query->where('module_id',$module_id)
                    ->where('module_type',$module_type);
                } 
                if (isset($feedback_by) && !empty($feedback_by)) { 
                    $query->where('feedback_by',$feedback_by);                 
                } 
                if (isset($feedback_to) && !empty($feedback_to)) { 
                    $query->where('feedback_to',$feedback_to);                 
                }  
            })->get();
            $feedback_data['feedbackTo']   = Feedback::with('feedbackBy_users')
            ->Where(function($query) use ($module_id,$feedback_by,$feedback_to,$module_type) {
                if (isset($apoinment_id) && !empty($module_id)) { 
                    $query->where('module_id',$module_id)
                    ->where('module_type',$module_type);
                } 
                if (isset($feedback_to) && !empty($feedback_to)) { 
                    $query->where('feedback_by',$feedback_to);                 
                } 
                if (isset($feedback_by) && !empty($feedback_by)) { 
                    $query->where('feedback_to',$feedback_by);                 
                }  
            })->get();
        }else{
            $feedback_data['feedbackBy']   = Feedback::with('feedbackBy_users')->where('feedback_to',$feedback_by)->get();
        }
        return $feedback_data;
    }
}
