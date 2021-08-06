<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\Designation;
use App\Models\Feedback;
use App\Http\Resources\Designation as DesignationArtical;
use App\Http\Resources\CustomerProfile;
use App\Http\Resources\Expert; 
use App\Http\Resources\Feedback as FeedbackArtical; 
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
			'user_name.required' 	=> 'Email address / Mobile number should be required',
			'user_password.required' 	=> 'Password should be required',
            'user_password.min'         => 'Password minimun lenght :min characters',
            'user_password.max'         => 'Password maximum lenght :max characters',
            'user_password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
		];

		$rules = [
			'user_name' 	=> 'required',
			'user_password' 	=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
		];
		
        $validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			$user_exist = $this->User->login_account($request->user_name, md5($request->user_password), $user_data);
			if($user_exist)
			{
				if($user_data->user_role->role_id == 3){
					$user_data = new CustomerProfile($user_data); 
				}else if($user_data->user_role->role_id == 2){
					$user_data = new Expert($user_data);
				}  
				$data = ['user_data'=>$user_data,'role'=>$user_data->user_role->role_id];
				return $this->sendSuccess($data, 'Logged in successfully');
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
			return $this->sendSuccess(['mobile_number'=>$request->mobile_number,'mobile_otp' => rand(1111,9999)], 'OTP sent successfully');
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
			'user_name.required' 	=> 'Email address / Mobile number should be required',
		];

		$rules = [
			'user_name' 	=> 'required',
		];
		
        $validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			$user_name = $request['user_name'];
			$user_data = User::Select('*')->Where(function ($query) use ($user_name) {
				$query->where('email_address',$user_name)
					  ->orWhere('mobile_number',$user_name);
			})->first();
			if(isset($user_data))
			{
				$otp = rand(1111,9999);
				$details = array(
					'name'         	=> $user_data->full_name,
					'mobile' 		=> $user_data->mobile_number,
					'email' 		=> $user_data->email_address,    
					'user_id'       => $user_data->user_id,
					'otp'			=> $otp,
				);   
				\Mail::to($user_data->email_address)->send(new \App\Mail\ForgotPasswordMail($details));

				return $this->sendSuccess(['user_id' => $user_data->user_id, 'mobile_otp' => $otp], 'OTP send on your registered mobile number');
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
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function designation_list()
	{
		try
		{
			$record_data = Designation::OrderBy('designation_title')->get();
			if(isset($record_data))
			{
				$record_data = DesignationArtical::collection($record_data);
				return $this->sendSuccess($record_data, 'Designation listed successfully');
			}
			else
			{
				return $this->sendFailed('Designation not found', 200);       
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

	public function commonFunction()
	{
		try
		{
		    $record_data = Designation::OrderBy('designation_title')->get();
		    if(count($record_data)>0)
			{
				$data['designation'] =  DesignationArtical::collection($record_data); 
			}else{
			    $data['designation'] = array();
			}
			// 	$data['specializationPlan'] = array(
			// 	'Crisis intervention- immediate appointment and no diagnosis',
			//  'Deeper therapy route - consultation, screening and diagnosis and treatment ( a long term treatment).',
			//  'Expression therapy route. Self enhancing & experiential mode.',
			//  'For general expertise guidance for issues like loneliness, relationships and so on where no diagnosis needed but yet professional help would make its difference.');
			
			$data['pricingPlan'] = [
			        '3month_plan'=>[[
    			            'month'=>'3 Months',
        			        'plan_detail'=>'Basic plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"2100"
                        ],
                        [
                             'month'=>'3 Months',
        			        'plan_detail'=>'Advance plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"5300"
                        ],[
                             'month'=>'3 Months',
        			        'plan_detail'=>'Subscription plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"1500"
                        ]],
                    '6month_plan'=>[[
    			            'month'=>'6 Months',
        			        'plan_detail'=>'Basic plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"1900"
                        ],
                        [
                             'month'=>'6 Months',
        			        'plan_detail'=>'Advance plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"5000"
                        ],[
                             'month'=>'6 Months',
        			        'plan_detail'=>'Subscription plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"1300"
                        ]] ,
			     '12month_plan'=>[[
    			            'month'=>'12 Months',
        			        'plan_detail'=>'Basic plan',
                           'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"1100"
                        ],
                        [
                             'month'=>'12 Months',
        			        'plan_detail'=>'Advance plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"4800"
                        ],[
                             'month'=>'12 Months',
        			        'plan_detail'=>'Subscription plan',
                            'plan_info'=>['Self hosted store','Self hosted store','Self hosted store','Self hosted store'],
                            'plan_amount'=>"1250"
                        ],
                    ]
			    ];
			 
			return $this->sendSuccess($data, 'Data listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	} 
	
	public function update_profile_pic(Request $request, $user_id)
	{
		$error_message = 	[
			'user_image.required'       => 'Profile image should be required', 
		];

		$rules = [ 
            'user_image' 	    => 'required|mimes:jpeg,jpg,png', 
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
			    $fileName = time() . '.' . $request->file('user_image')->getClientOriginalExtension();
                $request->file('user_image')->move(public_path('user_images'), $fileName);

				User::findOrfail($user_id)->update(['user_image' => $fileName]); 
			\DB::commit();
			return $this->sendSuccess('', 'Profile Image updated successfully');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}