<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Resources\CustomerProfile;
use Hash;
use DB;

class CustomerController extends BaseController
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
	
	public function store(Request $request)
	{
		$error_message = 	[
			'full_name.required' 	    => 'Full name should be required',
            'user_gender.required' 	    => 'Gender should be required',
			'user_dob.required' 	    => 'DOB should be required',
            'country_id.required' 	    => 'Country should be required',
            'state_id.required' 	    => 'State should be required',
            'city_id.required' 	        => 'City should be required',
            'mobile_number.required' 	=> 'Mobile number should be required',
			'email_address.required' 	=> 'Email address should be required',
			'user_password.required' 	=> 'Password should be required',
			'confirm_password.required' => 'Confirm password should be required',
			'mobile_number.unique' 		=> 'Mobile number already exist',
			'email_address.unique' 		=> 'Email address already exist',
			'full_name.min' 			=> 'Full name minimum :min characters',
			'full_name.max' 			=> 'Full name maximum :max characters',
			'email_address.max' 		=> 'Email address maximum :max characters',
			'email_address.regex' 		=> 'Provide valid email address',
            'user_password.min'         => 'Password minimun lenght :min characters',
            'user_password.max'         => 'Password maximum lenght :max characters',
            'user_password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password did not matched',
            'accepted'                  => 'Accept terms & conditions',
		];

		$rules = [
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number',
			'email_address' 	=> 'required|max:50|unique:users,email_address|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'user_gender' 	    => 'required',
			'country_id' 	    => 'required',
			'state_id' 	        => 'required',
			'city_id' 	        => 'required',
			'user_dob' 	        => 'required',
			'user_password'		=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:user_password|same:user_password',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
				$user = new User();
				$user->fill($request->all());
				$user->user_password = md5($request->user_password);
				$user->save();

				$user_role = new UserRole;
                $user_role->role_id = 3;
                $user_role->user_id = $user->user_id;
                $user_role->save();

				$otp = rand(1111,9999);
				$details = array(
					'name'         	=> $request->full_name,
					'mobile' 		=> $request->mobile_number,
					'email' 		=> $request->email_address,   
					'password'      => $request->user_password,
					'user_id'       => $user->user_id,
					'otp'			=> $otp,
				);   
				// \Mail::to($request->email_address)->send(new \App\Mail\NewUserMail($details));

			\DB::commit();
			$user_data = User::find($user->user_id); 
			$user_data = new CustomerProfile($user_data);
			return $this->sendSuccess(['user_data'=>$user_data,'user_id' => $user->user_id, 'mobile_otp' =>$otp], 'OTP sent on your mobile number');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function update(Request $request, $user_id)
	{
		$error_message = 	[
			'full_name.required' 	    => 'Full name should be required',
            'user_gender.required' 	    => 'Gender should be required',
			'user_dob.required' 	    => 'DOB should be required',
            'country_id.required' 	    => 'Country should be required',
            'state_id.required' 	    => 'State should be required',
            'city_id.required' 	        => 'City should be required',
            'user_dob.required' 	    => 'DOB should be required',
            'mobile_number.required' 	=> 'Mobile number should be required',
			'email_address.required' 	=> 'Email address should be required',
			'user_password.required' 	=> 'Password should be required',
			'confirm_password.required' => 'Confirm password should be required',
			'mobile_number.unique' 		=> 'Mobile number already exist',
			'email_address.unique' 		=> 'Email address already exist',
			'full_name.min' 			=> 'Full name minimum :min characters',
			'full_name.max' 			=> 'Full name maximum :max characters',
			'email_address.max' 		=> 'Email address maximum :max characters',
			'email_address.regex' 		=> 'Provide valid email address',
		];

		$rules = [
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number,'.$user_id.',user_id',
			'email_address' 	=> 'required|max:50|unique:users,email_address,'.$user_id.',user_id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'user_gender' 	    => 'required',
			'country_id' 	    => 'required',
			'state_id' 	        => 'required',
			'city_id' 	        => 'required',
			'user_dob' 	        => 'required',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
				User::findOrfail($user_id)->update($request->all());
				$user_data = new CustomerProfile(User::findOrfail($user_id));
			\DB::commit();
			return $this->sendSuccess($user_data, 'Profile updated successfully');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function show($user_id)
	{
		try
		{
			$user_data = User::find($user_id);
			if(isset($user_data))
			{
				$user_data = new CustomerProfile($user_data);
				return $this->sendSuccess($user_data, 'Profile listed successfully');
			}
			else
			{
				return $this->sendFailed('Unauthorized access',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}