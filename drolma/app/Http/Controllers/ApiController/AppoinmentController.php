<?php

namespace App\Http\Controllers\ApiController;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\Availability;
use App\Models\Appointment; 
use App\Http\Resources\Appointment as Appointments; 
use App\Http\Controllers\ApiController\BaseController as BaseController;
use CommonFunction;

class AppoinmentController extends BaseController
{
    public function __construct() 
	{
        $this->User = new User;

        //header("Content-Type: application/json");
		$valid_passwords = array ("drolmaa" => "026866326a9d1d2b23226e4e5317569f");
		$valid_users = array_keys($valid_passwords);

		$user = request()->server('PHP_AUTH_USER');
		$pass = request()->server('PHP_AUTH_PW');

		$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

		if (!$validated) {
		  header('WWW-Authenticate: Basic realm="My Realm"');
		  header('HTTP/1.0 401 Unauthorized');
		  $re = array(
		  	"status" 	=> false,
		  	"message"	=> "You're not authorized to access."
		  );
		  echo json_encode($re, JSON_PRETTY_PRINT);
		  die;
		}
		
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$user_id)
    { 
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];

        $users = $this->User->user_data($user_id, $user_data); //users data

        if($user_data->user_role->role_id == 3){
            $previous = Appointment::where('user_id',$user_id)->whereIn('status',[config('constant.STATUS.REJECTED'),config('constant.STATUS.COMPLETED'),config('constant.STATUS.CANCELLED')])
            ->Where(function($query) use ($from_date,$to_date) {
                if ((isset($from_date) && !empty($from_date)) && (isset($to_date) && !empty($to_date))) {  
                    $query->whereDate('date', '>=', $from_date);
                    $query->whereDate('date', '<=', $to_date);
                } 
            })->orderBy('appointment_id','desc')->get();
            $upcomming = Appointment::where('user_id',$user_id)->whereIn('status',[config('constant.STATUS.PENDING'),config('constant.STATUS.ACCEPTED')])
            ->Where(function($query) use ($from_date,$to_date) {
                if ((isset($from_date) && !empty($from_date)) && (isset($to_date) && !empty($to_date))) { 
                    $query->whereDate('date', '>=', $from_date);
                    $query->whereDate('date', '<=', $to_date);
                } 
            })->orderBy('appointment_id','desc')->get();
        }else if($user_data->user_role->role_id == 2){
            $previous = Appointment::where('expert',$user_id)->whereIn('status',[config('constant.STATUS.REJECTED'),config('constant.STATUS.COMPLETED'),config('constant.STATUS.CANCELLED')])
            ->Where(function($query) use ($from_date,$to_date) {
                if ((isset($from_date) && !empty($from_date)) && (isset($to_date) && !empty($to_date))) { 
                    $query->whereDate('date', '>=', $from_date);
                    $query->whereDate('date', '<=', $to_date);
                } 
            })->orderBy('appointment_id','desc')->get();
            $upcomming = Appointment::where('expert',$user_id)->whereIn('status',[config('constant.STATUS.PENDING'),config('constant.STATUS.ACCEPTED')])
            ->Where(function($query) use ($from_date,$to_date) {
                if ((isset($from_date) && !empty($from_date)) && (isset($to_date) && !empty($to_date))) { 
                    $query->whereDate('date', '>=', $from_date);
                    $query->whereDate('date', '<=', $to_date);
                } 
            })->orderBy('appointment_id','desc')->get();
        }     
        $data['upcomming'] = Appointments::collection($upcomming);
        $data['previous'] = Appointments::collection($previous); 
        return $this->sendSuccess($data, 'Data listed successfully'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //get available time slots
    public function getTimeslot(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'date' 	                => 'required',
            'expert_id' 	                => 'required',	  	 
        ],[
            'date.required'         => 'Date should be required',
            'expert_id.required'         => 'Expert Id should be required',  
		]); 

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

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
        if(count($timeslot_list)>0){
            return $this->sendSuccess($timeslot_list, 'Data listed successfully'); 
        }else{
            return $this->sendFailed('No record found',200);
        }       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request)
	{ 
		$validator = Validator::make($request->all(),[
			'name' 	                => 'required|min:3|max:30',
			'plan' 	                => 'required',
            'designation' 	        => 'required',
            'expert' 	            => 'required',
            'date' 	                => 'required',
            'time_slot' 	                => 'required',	 
            'amount'                => 'required',	
            'user_id'                => 'required',		 
        ],[
            'user_id.required'      => 'User Id should be required',
			'name.required'         => 'Name should be required',
            'name.min'              => 'Name should be minimum of 3 characters',
            'name.max'              => 'Name should be maximum of 30 characters',
			'plan.required' 	    => 'Plan should be required',
            'designation.required'  => 'Designation should be required',
            'expert.required'       => 'Expert should be required',
            'date.required'         => 'Date should be required',
            'time_slot.required'         => 'Time should be required', 
            'amount.required'       => 'Amount should be required',
		]); 

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction(); 
                $appointment = new Appointment();
                $appointment->fill($request->all()); 
                $appointment->time = $request->time_slot;
                $appointment->appoinment_no = "AP-".rand(11111,99999);
                $appointment->status = config('constant.STATUS.PENDING');
                $appointment->save();  
            \DB::commit(); 
            return $this->sendSuccess(['appointment_id'=>$appointment->appointment_id], 'Appointment created successfully'); 
        }
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function changeStatusAppoinment($id,$status)
    {  
        $appoinment = Appointment::findOrfail($id); 
        if($status == config('constant.STATUS.CANCELLED') || $status == config('constant.STATUS.REJECTED')){
            if($status == config('constant.STATUS.CANCELLED')){
                $amount = ($appoinment->amount*35)/100; 
            }else{
                $amount = $appoinment->amount; 
            }
            $refundData = CommonFunction::refundPayment($appoinment->payment_id,$amount,'Appoinment'); 
            $time1 = strtotime(date('Y-m-d H:i:s'));$time2 = strtotime(date('Y-m-d H:i:s',strtotime($appoinment->date.' '.$appoinment->time))); $difference = round(($time2 - $time1) / 3600);
            if($difference >= 48){  
                $count_row = Appointment::where('appointment_id',$id)->update(['amount_refund'=>$refundData['amount_refund'],'refund_id'=>$refundData['id'],'status'=>$status,'updated_at'=>date('Y-m-d H:i:s')]); 
                if(!empty($count_row)){
                    $appoinment = Appointment::findOrfail($id); 
                    $appointment_data = new Appointments($appoinment);
                    if($refundData['status'] == 'success'){
                        return $this->sendSuccess($appointment_data, 'Appointment '.strtolower(array_search($status,config('constant.STATUS'))).' successfully and '.$refundData['description']);
                    }else{
                        return $this->sendSuccess($appointment_data, 'Appointment '.strtolower(array_search($status,config('constant.STATUS'))).' successfully and '.$refundData['description']);
                    }       
                }else{
                    return $this->sendFailed('Something went wrong',200);
                }
            }else{
                return $this->sendFailed('You are not allowded to '.strtolower(array_search($status,config('constant.STATUS'))).' this appointment',200);
            }
        }else{
            $count_row = Appointment::where('appointment_id',$id)->update(['status'=>$status,'updated_at'=>date('Y-m-d H:i:s')]); 
            if(!empty($count_row)){
                $appoinment = Appointment::findOrfail($id); 
                $appointment_data = new Appointments($appoinment);
                return $this->sendSuccess($appointment_data, 'Appointment '.strtolower(array_search($status,config('constant.STATUS'))).' successfully'); 
            }else{
                return $this->sendFailed('Something went wrong',200);
            }
        }
    } 
}
