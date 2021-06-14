<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Availability extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;

    protected $table    = 'availability';
    protected $primaryKey = 'availability_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time_slot','status','date','user_id','time','created_at','updated_at'
    ];
 
    protected $dates = [ 'deleted_at' ];

    public function recordExist($availDate,$user_id){
        $record = Availability::where('date',$availDate)->where('user_id',$user_id)->first();
        return $record;
    }
}
