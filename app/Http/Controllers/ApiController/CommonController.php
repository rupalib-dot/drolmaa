<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Http\Resources\CustomerProfile;
use Hash;
use DB;

class CommonController extends BaseController
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

	public function login_account(Request $request)
	{
		$error_message = 	[
			'email_address.required' 	=> 'Email address / Mobile number should be required',
			'user_password.required' 	=> 'Password should be required',
            'user_password.min'         => 'Password minimun lenght :min characters',
            'user_password.max'         => 'Password maximum lenght :max characters',
            'user_password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
		];

		$rules = [
			'email_address' 	=> 'required',
			'user_password' 	=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
		];
		
        $validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			$user_exist = $this->User->login_account($request->email_address, md5($request->user_password), $user_data);
			if($user_exist)
			{
				$user_data = new CustomerProfile($user_data);
				return $this->sendSuccess($user_data, 'Logged in successfully');
			}
			else
			{
				return $this->sendFailed('We could not found any account with that info',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	
	public function resend_otp(Request $request)
	{
		$error_message = 	[
			'required'	=> 'Mobile number should be required',
			'digits' 	=> 'Mobile number should be :digits digits',
		];

		$rules = [
			'mobile_number' 	=> 'required|digits:10',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);
		
		if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			return $this->sendSuccess(['mobile_otp' => rand(1111,9999)], 'OTP sent successfully');
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function change_password(Request $request)
	{
		$error_message = 	[
			'user_id.required' 			=> 'User Id should be required',
			'old_password.required' 	=> 'Old password should be required',
			'new_password.required' 	=> 'New password should be required',
			'confirm_password.required' => 'Confirm password should be required',
            'new_password.min'         	=> 'Password minimun lenght :min characters',
            'new_password.max'         	=> 'Password maximum lenght :max characters',
            'new_password.regex'       	=> 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password should be same as new password',
            'different'                 => 'New password should not be same as previous password'
		];

		$rules = [
			'user_id'			=> 'required',
			'old_password'		=> 'required',
			'new_password'		=> 'required|min:8|max:16|different:old_password|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:new_password|same:new_password',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
				$user_count = User::where('user_id',$request->user_id)->where('user_password',md5($request->old_password))->count();
				if($user_count > 0)
				{
					$request['user_password'] = md5($request->new_password);
					User::findOrfail($request->user_id)->update($request->only(['user_password']));
					return $this->sendSuccess('', 'Password update successfully');
				}
				else
				{
					return $this->sendFailed('Invalid old password', 200);
				}

			\DB::commit();
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function forgot_password(Request $request)
	{
		$error_message = 	[
			'mobile_number.required' 	=> 'Email address / Mobile number should be required',
		];

		$rules = [
			'mobile_number' 	=> 'required',
		];
		
        $validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			$user_data = User::Select('user_id','mobile_number')->where('mobile_number',$request->mobile_number)->first();
			if(isset($user_data))
			{
				return $this->sendSuccess(['user_data' => $user_data, 'mobile_otp' => rand(1111,9999)], 'OTP send on your registered mobile number');
			}
			else
			{
				return $this->sendFailed('We could not found any account with that info',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function reset_password(Request $request)
	{
		$error_message = 	[
			'user_id.required' 			=> 'User Id should be required',
			'new_password.required' 	=> 'New password should be required',
			'confirm_password.required' => 'Confirm password should be required',
            'new_password.min'         	=> 'Password minimun lenght :min characters',
            'new_password.max'         	=> 'Password maximum lenght :max characters',
            'new_password.regex'       	=> 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password should be same as new password',
            'different'                 => 'New password should not be same as previous password'
		];

		$rules = [
			'user_id'			=> 'required',
			'new_password'		=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:new_password|same:new_password',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
				$user_data = User::find($request->user_id);
				if(isset($user_data))
				{
					$request['user_password'] = md5($request->new_password);
					User::find($request->user_id)->update($request->only(['user_password']));
					return $this->sendSuccess('', 'Password changed successfully');
				}
				else
				{
					return $this->sendFailed('Invalid access', 200);       
				}
			\DB::commit();
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}