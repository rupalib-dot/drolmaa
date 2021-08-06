<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\Bookings;
use App\Http\Resources\Booking as BookingArtical;
use Hash;
use DB;

class BookingController extends BaseController
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
        $error_message = 	[
			'user_id.required'       => 'User id should be required',
		];

        $validatedData = [
			'user_id' 	        => 'required',
		];

		$validator = Validator::make($request->all(), $validatedData, $error_message);
   
        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }
		try
		{
			$booking_data = Bookings::where('user_id',$request->user_id)->OrderBy('created_at','DESC')->get();
			if(count($booking_data) > 0)
			{
				$workshop_data = BookingArtical::collection($booking_data);
				return $this->sendSuccess($workshop_data, 'Bookings listed successfully');
			}
			else
			{
				return $this->sendFailed('Workshop not found',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}

	}

    public function store(Request $request)
    {
        $error_message = 	[
			'user_id.required'       => 'User id should be required',
			'booking_no.required'    => 'Booking number should be required',
			'module_id.required'     => 'Workshop should be required',
			'payment_id.required'    => 'Payment id should be required',
		];

        $validatedData = [
			'user_id' 	        => 'required',
			'booking_no' 	    => 'required',
			'module_id' 	    => 'required',
			'payment_id' 	    => 'required',
		];

		$validator = Validator::make($request->all(), $validatedData, $error_message);
   
        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

        try
        {
            $count_record = Bookings::where('user_id',$request->user_id)->where('module_id',$request->module_id)->count();
            if($count_record > 0)
            {
                return $this->sendFailed('Already booked', 200); 
            }
            else
            {
                \DB::beginTransaction();
                    $booking = new Bookings;
                    $booking->fill($request->all());
                    $booking->module_type   = config('constant.BOOKING.WORKSHOP');
                    $booking->payment_mode  = config('constant.PAYMENT_MODE.ONLINE');
                    $booking->save();
                \DB::commit();
                $booking_data = BookingArtical::collection(Bookings::where('user_id',$request->user_id)->get());
                return $this->sendSuccess($booking_data, 'Profile updated successfully');
            }
        }
        catch (\Throwable $e) 
        {
            \DB::rollback();
            return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
        }
    }
}