<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\Availability;
use App\Models\Appointment;
use App\Http\Resources\Appointment as AppointmentArtical;
use App\Http\Resources\Availability as AvailabilityArtical;
use App\Http\Resources\Expert;
use CommonFunction;
use DB;

class AppointmentController extends BaseController
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

	public function appointment_plan_list()
	{
		$plan_list = config('constant.PLAN');
		return $this->sendSuccess($plan_list, 'Plan listed successfully');
	}

	public function expert_list($designation_id)
	{
		try
		{
			$record_data = User::where('designation_id',$designation_id)->get();
			if(count($record_data) > 0)
			{
				$record_data = Expert::collection($record_data);
				return $this->sendSuccess($record_data, 'Expert listed successfully');
			}
			else
			{
				return $this->sendFailed('Expert not found',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function availability_slot_list($user_id, $date)
	{
		try
		{
			$record_data = Availability::where('user_id',$user_id)->whereDate('date',$date)->where('status',config('constant.AVAIL_STATUS.AVAILABLE'))->get();
			if(count($record_data) > 0)
			{
				$record_data = AvailabilityArtical::collection($record_data);
				return $this->sendSuccess($record_data, 'Availability time slot listed successfully');
			}
			else
			{
				return $this->sendFailed('Availability slot not found',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
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
			'user_id'			=> 'required',
			'name'				=> 'required|max:32',
            'plan'				=> 'required',
            'designation'		=> 'required',
            'expert'			=> 'required',
            'date'				=> 'required',
            'time'				=> 'required',
            'amount'			=> 'required',
            'payment_id'		=> 'required',
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

	public function appointment_cancel($appointment_id)
	{
		try
		{
			$record_data 		= Appointment::findOrfail($appointment_id);
			$current_time       = strtotime(date('Y-m-d H:i:s'));
			$appointment_time   = strtotime(date('Y-m-d H:i:s',strtotime($record_data->date.' '.$record_data->time))); 
			$difference = round(($appointment_time - $current_time) / 3600);
			if($difference >= 48)
			{
				$refundData = CommonFunction::refundPayment($record_data->payment_id, $record_data->amount);
				if($refundData['status'] == 'success')
				{
					Appointment::where('appointment_id',$record_data->appointment_id)->update(['amount_refund' => $refundData['amount_refund'],'refund_id' => $refundData['id'], 'status' => config('constant.STATUS.CANCELLED')]); 
					$record_data = AppointmentArtical::collection(Appointment::where('user_id',$record_data->user_id)->get());
					return $this->sendSuccess($record_data, 'Appointment has been cancelled successfully and payment is refunded successfully');
				}
				else
				{
					return $this->sendFailed('Invalid transaction', 200);
				}
			}
			else
			{
				return $this->sendFailed('You are not allowed to cancel now', 200);  
			}
		}
		catch (\Throwable $e)
    	{
			\DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}