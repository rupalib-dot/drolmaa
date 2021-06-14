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
use DB;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->State    = new State;
        $this->City     = new City;
        $this->User     = new User;
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
        ->where('users.deleted_at',NULL)
        ->where('user_role.role_id',2)
        ->get();
        return response()->json($city_list);
    }

    public function get_workshop_detail(Request $request)
    {
        $workshop_detail  = Workshop::select('workshop.*') 
        ->where('workshop.workshop_id',$request->module_id)
        ->where('workshop.deleted_at',NULL) 
        ->first();

        // $html = '<div class="row" style="margin:20px"><div class="col-lg-6">';
        // $html .= '<p>Title:- '.$workshop_detail->title.'</p>';
        // $html .= '<p>Designation:- '.CommonFunction::GetSingleField('designation','designation_title','designation_id',$workshop_detail->designation).'</p>';
        // $html .= '<p>Expert:- '.CommonFunction::GetSingleField('users','full_name','user_id',$workshop_detail->expert).'</p>';
        // $html .= '<p>Price:- '.$workshop_detail->price.'</p>';
        // $html .= '</div><div class="col-lg-6"><p>Date:- '.date('M d,Y',strtotime($workshop_detail->date)).'</p>';
        // $html .= '<p>Time:- '.date('h:i A',strtotime($workshop_detail->time)).'</p></div> ';
        // $html .= '<form action="'.route('bookings.store').'" method="POST"><input type="hidden" name="_token" id="csrf-token" value="'.Session::token().'"><input type="hidden" value="'.$request->module_id.'" name="module_id"><input type="hidden" value="'.config('constant.BOOKING.WORKSHOP').'" name="module_type"><script src="https://checkout.razorpay.com/v1/checkout.js" data-key="'.env('RAZORPAY_KEY') .'" data-amount="'.$workshop_detail->price.'00" data-buttontext="Pay '.$workshop_detail->price.' INR" data-name="i4consulting.org" data-description="Rozerpay" data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png" data-prefill.name="'.Session::get('full_name').'" data-prefill.email="rupalibhargava@gmail.com" data-theme.color="#ff7529"> </script></form> </div>';
        
            $data = array(
                'title' => 'Title:- '.$workshop_detail->title ,
                'designation' => 'Designation:- '.CommonFunction::GetSingleField('designation','designation_title','designation_id',$workshop_detail->designation),
                'expert' => 'Expert:- '.CommonFunction::GetSingleField('users','full_name','user_id',$workshop_detail->expert),
                'price' => 'Price:- '.$workshop_detail->price,
                'date' => 'Date:- '.date('M d,Y',strtotime($workshop_detail->date)),
                'time' => 'Time:- '.date('h:i A',strtotime($workshop_detail->time)),
                'action' => route('bookings.store'),
                'module_id' => $request->module_id,
                'module_type' => config('constant.BOOKING.WORKSHOP'),
                'amount' => $workshop_detail->price.'00',
                'buttonText' => 'Pay '.$workshop_detail->price.' INR',
            );
        
        return response()->json($data);
        //  <button class="login1 btn" type="submit" name="submit">Submit</button>
    }
    
    public function get_timeslot(Request $request)
    {
        $timeslot_list  = Availability::select('time_slot','time') 
        ->where('date',date('Y-m-d',strtotime($request->date)))
        ->where('status',config('constant.AVAIL_STATUS.AVAILABLE'))
        ->where('user_id',$request->expert_id) 
        ->get();  
        return response()->json($timeslot_list);
    }
}