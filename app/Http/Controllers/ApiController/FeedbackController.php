<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\Feedback;
use App\Http\Resources\Appointment as AppointmentArtical;
use Hash;
use DB;

class FeedbackController extends BaseController
{
	public function __construct() 
	{
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

	public function index(Request $request)
	{
		try
		{
			$record_data = AppointmentArtical::collection(Appointment::where('user_id',$request->user_id)->get());
			return $this->sendSuccess($record_data, 'Appointment listed successfully');
		}
		catch (\Throwable $e)
    	{
			\DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
	
	public function store(Request $request)
	{
		$error_message = 	[
			'user_id.required' 			=> 'User Id should be required',
			'name.required' 			=> 'Name should be required',
			'plan.required' 			=> 'Plan should be required',
            'designation.required'      => 'Designation should be required',
            'expert.required'      		=> 'Expert should be required',
            'date.required'      		=> 'Date should be required',
            'time.required'      		=> 'Time should be required',
            'amount.required'      		=> 'Amount should be required',
            'payment_id.required'      	=> 'Payment Id should be required',
            'max'         				=> 'Name maximum lenght :max characters',
		];

		$rules = [
			'feedback_by'			=> 'required',
			'feedback_to'			=> 'required|max:32',
            'rating'				=> 'required',
            'message'		        => 'required',
            'module_type'			=> 'required',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
				$appointment = new Appointment;
				$appointment->fill($request->all());
				$appointment->appoinment_no = "AP-".rand(11111,99999);
				$appointment->status 		= config('constant.STATUS.PENDING');
				$appointment->payment_mode 	= config('constant.PAYMENT_MODE.ONLINE');
				$appointment->save();

				Availability::where('user_id',$request->expert)->where('time',$request->time)->update(['status'=>config('constant.AVAIL_STATUS.BOOKED')]);
			\DB::commit();
			$record_data = AppointmentArtical::collection(Appointment::where('user_id',$request->user_id)->get());
			return $this->sendSuccess($record_data, 'Appointment booked successfully');
		}
		catch (\Throwable $e)
    	{
			\DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}