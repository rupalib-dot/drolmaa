<?php

namespace App\Http\Controllers\CommonController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\User;
use App\Models\City;
use App\Models\Availability;
use Session;
use CommonFunction;
use App\Models\Workshop;
use App\Models\Bookings;
use DB;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->State    = new State;
        $this->City     = new City;
        $this->User     = new User;
    }

    public function plan_amount(Request $request){
        $amount  = array_search($request->plan,config('constant.PLAN_RATE'));
        return response()->json($amount);
    }
    public function get_state(Request $request)
    {
        $state_list  = State::Where('country_id',$request->country_id)->get(['state_id','state_name']);
        return response()->json($state_list);
    }

    public function get_city(Request $request)
    {
        $city_list  = City::Where('state_id',$request->state_id)->get(['city_id','city_name']);
        return response()->json($city_list);
    }

    public function get_expert(Request $request)
    {
        $city_list  = User::select('users.user_id','users.full_name')
        ->join('user_role','user_role.user_id','=','users.user_id')
        ->where('users.designation_id',$request->designation_id) 
        ->Where(function($query) use ($request) {
            if (isset($request->expert_id) && !empty($request->expert_id)) { 
                $query->where('users.user_id',$request->expert_id);
            } 
        }) 
        ->where('users.deleted_at',NULL)
        ->where('user_role.role_id',2)
        ->orderBy('user_id','desc')
        ->get();
        return response()->json($city_list);
    }

    public function get_workshop_detail(Request $request)
    {
        $bookingExist = Bookings::select('booking_id')->where('user_id',Session::get('user_id'))->where('module_id',$request->module_id)->first();
        if(empty($bookingExist)){  
            $workshop_detail  = Workshop::select('workshop.*') 
            ->where('workshop.workshop_id',$request->module_id)
            ->where('workshop.deleted_at',NULL) 
            ->orderBy('workshop_id','desc')
            ->first();
    
            $data = array(
                'title' => 'Title:- '.$workshop_detail->title ,
                'designation' => 'Designation:- '.CommonFunction::GetSingleField('designation','designation_title','designation_id',$workshop_detail->designation),
                'expert' => 'Expert:- '.CommonFunction::GetSingleField('users','full_name','user_id',$workshop_detail->expert),
                'price' => 'Price:- '.$workshop_detail->price,
                'date' => 'Date:- '.date('M d,Y',strtotime($workshop_detail->date)), 
                'start_date' => 'Start Date:- '.date('M d,Y',strtotime($workshop_detail->start_date)), 
                'time' => 'Time:- '.date('h:i A',strtotime($workshop_detail->time)),
                'action' => route('bookings.store'),
                'module_id' => $request->module_id,
                'module_type' => config('constant.BOOKING.WORKSHOP'),
                'amount' => $workshop_detail->price.'00',
                'buttonText' => 'Pay '.$workshop_detail->price.' INR',
            ); 
             
            return Response()->json([
               "success" => true,
               "message" =>$data,
           ]); 
             
        } 
        else{  
           return Response()->json([
               "success" => false,
               "message" => 'You have already booked this workshop',
           ]); 
        }  
    }
    
    
    
    public function get_timeslot(Request $request)
    {
        $timeslot_list  = Availability::select('time_slot','time') 
        ->where('date',date('Y-m-d',strtotime($request->date)))
        ->Where(function($query) use($request) {
            if (date('Y-m-d',strtotime($request->date)) == date('Y-m-d')) { 
                $query->where('time','>',date("H"));
            }  
        })
        ->where('status',config('constant.AVAIL_STATUS.AVAILABLE'))
        ->where('user_id',$request->expert_id) 
        ->orderBy('availability_id','desc')
        ->get();  
        return response()->json($timeslot_list);
    }
}