<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Resources\Expert;
use App\Models\Designation;
use App\Models\Subscription;
use CommonFunction;
use Session;
use Razorpay\Api\Api; 
use DateTime;
use Hash;
use DB;

class ExpertController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
	
	public function checkPhoneEmail(Request $request)
	{
		$error_message = 	[ 
            'mobile_number.required' 	=> 'Mobile number should be required',
			'email_address.required' 	=> 'Email address should be required', 
			'mobile_number.unique' 		=> 'Mobile number already exist',
			'email_address.unique' 		=> 'Email address already exist', 
			'email_address.max' 		=> 'Email address maximum :max characters',
			'email_address.regex' 		=> 'Provide valid email address', 
		];

		$rules = [ 
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number',
			'email_address' 	=> 'required|max:50|unique:users,email_address|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
	 	];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }else{
             //otp function
                $otp = rand(1, 1000000);   
                $sms_text = "Dear User " .$otp. " is your one time password (OTP) for registration. Please enter the OTP to proceed";
                $response = CommonFunction::sendSMS($request->mobile_number,$sms_text); 
			return $this->sendSuccess(['email_address' => $request->email_address,'mobile_number' => $request->mobile_number, 'mobile_otp' =>  $otp],'Data verified successfully');     
		}
	}

    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		$error_message = 	[
			'user_image.required'       => 'Profile image should be required',
			'full_name.required' 	    => 'Full name should be required',
			'mobile_number.required' 	=> 'Mobile number should be required',
			'email_address.required' 	=> 'Email address should be required',
			'user_age.required' 	    => 'Age should be required',
			'user_gender.required' 	    => 'Gender should be required',
			'country_id.required' 	    => 'Country should be required',
			'state_id.required' 	    => 'State should be required',
			'city_id.required' 	        => 'City should be required',
			'address_details.required' 	=> 'Address should be required',
			'mimes' 	                => 'Image type should be jpeg, jpg, png',
			'mobile_number.unique' 		=> 'Mobile number already exist',
			'email_address.unique' 		=> 'Email address already exist',
			'full_name.min' 			=> 'Full name minimum :min characters',
			'full_name.max' 			=> 'Full name maximum :max characters',
			'email_address.max' 		=> 'Email address maximum :max characters',
			'digits_between' 		    => 'Age should be 1 - 100',
			'address_details.max' 		=> 'Address maximum :max characters',
            'user_password.min'         => 'Password minimun lenght :min characters',
            'user_password.max'         => 'Password maximum lenght :max characters',
            'user_password.regex'       => 'Password Should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',
            'same'                      => 'Confirm password did not matched',
            'user_password.required' 	=> 'Password should be required',
			'confirm_password.required' => 'Confirm password should be required',
			'designation_id.required'       => 'Designation should be required',
			'user_experience.required' 	    => 'Experience should be required',
			'digits' 	                    => 'Phone number shoud be :digits digits',
			'licance_pic.required'                  => 'Professional license should be required',
			'pan_card_pic.required' 	            => 'PAN card should be required',
			'aadhar_card_pic.required' 	            => 'Aadhar card should be required',
			'professional_certificate_pic.required' => 'Professional certificate should be required',
			'mimes' 	                            => 'All documents should be jpeg, jpg, png format',
		];

		$rules = [
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number',
			'email_address' 				=> 'required|max:50|unique:users,email_address',
			'user_age' 	        			=> 'required|integer|digits_between: 1,100',
			'user_gender' 	    			=> 'required',
			'country_id' 	    			=> 'required',
			'state_id' 	        			=> 'required',
			'city_id' 	        			=> 'required',
			'address_details' 				=> 'required|max:150',
            'user_password'					=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'				=> 'required|required_with:user_password|same:user_password',
			'designation_id' 	    		=> 'required',
			'office_phone_number' 			=> 'required|digits:10',
			'user_experience' 	    		=> 'required',
			'licance_pic' 	                => 'required|mimes:jpeg,jpg,png',
			'pan_card_pic' 	                => 'required|mimes:jpeg,jpg,png',
			'aadhar_card_pic' 	            => 'required|mimes:jpeg,jpg,png',
			'professional_certificate_pic' 	=> 'required|mimes:jpeg,jpg,png',
            // 'amount'                        => 'required',
            // 'razorpay_payment_id'           => 'required', 
            // 'month'                         => 'required',
            // 'special_plan'                  => 'required',
            'user_image' 	    => 'required|mimes:jpeg,jpg,png',
            'user_dob'=>'required'
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
			$input = $request->all(); 
            // $month      =   explode('_',$input['month']);
            // $subPeriod  =   $month[0];
            // $subType    =   $month[1];
            // $today = date("Y-m-d");
            // $date = date('Y-m-d', strtotime('+'.$subPeriod.' month', strtotime($today)));


            // $api = new Api("rzp_test_tazXyaYClLVzyb", "QcFkC78PT0dkVGsPO8FWVMNB");
    
            // $payment = $api->payment->fetch($input['razorpay_payment_id']);
    
            // if(count($input)  && !empty($request['razorpay_payment_id'])) 
            // { 
                $fileName = time() . '.' . $request->file('user_image')->getClientOriginalExtension();
                $request->file('user_image')->move(public_path('user_images'), $fileName);

                $licance_pic = 'licance_pic_' . time() . '.' . $request->file('licance_pic')->getClientOriginalExtension();
                $request->file('licance_pic')->move(public_path('expert_documents'), $licance_pic);
    
                $pan_card_pic = 'pan_card_pic_' . time() . '.' . $request->file('pan_card_pic')->getClientOriginalExtension();
                $request->file('pan_card_pic')->move(public_path('expert_documents'), $pan_card_pic);
    
                $aadhar_card_pic = 'aadhar_card_pic_' . time() . '.' . $request->file('aadhar_card_pic')->getClientOriginalExtension();
                $request->file('aadhar_card_pic')->move(public_path('expert_documents'), $aadhar_card_pic);
    
                $professional_certificate_pic = 'professional_certificate_pic_' . time() . '.' . $request->file('professional_certificate_pic')->getClientOriginalExtension();
                $request->file('professional_certificate_pic')->move(public_path('expert_documents'), $professional_certificate_pic);
 
                if(count(explode(',',$request->special_plan))>2){
                    return $this->sendFailed('Select only 2 Plan', 200);   
                } 
                 
                // $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$request['amount']));  
                $expert = new User();
                $expert->fill($request->all());
                $expert->licance_pic                    = $licance_pic;
                $expert->pan_card_pic                   = $pan_card_pic;
                $expert->professional_certificate_pic   = $professional_certificate_pic;
                $expert->aadhar_card_pic                = $aadhar_card_pic;
                $expert->user_dob                = date('Y-m-d',strtotime($request->user_dob));
                $expert->user_image = $fileName;
				$expert->user_password = md5($request->user_password);
                // $expert->payment_id = $request['razorpay_payment_id'];
                // $expert->register_amount = round($request['amount'], 2); 
                // $expert->special_plan = $request->special_plan;  
                $expert->save(); 

                $user_role = new UserRole;
                $user_role->role_id = 2;
                $user_role->user_id = $expert->user_id;
                $user_role->save();

                //expert subscription entry
                // $detail = array(
                //     'payment_id' =>$request['razorpay_payment_id'],
                //     'month' => $subPeriod,
                //     'plan_detail' =>  $subType,
                //     'register_amount' =>round($request['amount'], 2),
                //     'user_id' => $expert->user_id,
                //     'start_date'=>$today,
                //     'end_date' => $date,
                //     'payment_mode'=>config('constant.PAYMENT_MODE.ONLINE'),
                //     'created_at'=>  date("Y-m-d H:i:s"),
                //     'updated_at'=>  date("Y-m-d H:i:s"),
                // );
                // Subscription::create($detail);
 

                //mail to new user
                $details = array(
                    'name'          => $expert->full_name,
                    'mobile' 		=> $expert->mobile_number,
                    'email' 		=> $expert->email_address,   
                    'password'      => $expert->user_password,
                    'user_id'       => $expert->user_id,
                );   
				// \Mail::to($request->email_address)->send(new \App\Mail\NewUserMail($details));

                \DB::commit();
                return $this->sendSuccess(['user_id'=>$expert->user_id,'mobile_number' => $request->mobile_number], 'OTP sent on your mobile number');
            // }
        }
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}

    public function store_payment(Request $request)
	{
		$error_message = 	[
			'user_id.required'       => 'User Id should be required',
			'amount.required'       => 'Amount should be required',
			'razorpay_payment_id.required'       => 'Razor Pay Payment Id should be required',
			'month.required'       => 'Month should be required',
		];

		$rules = [
			'user_id' 	    => 'required', 
            'amount'                        => 'required',
            'razorpay_payment_id'           => 'required', 
            'month'                         => 'required',
		];

		$validator = Validator::make($request->all(), $rules, $error_message);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			\DB::beginTransaction();
			$input = $request->all();  
            $month      =   explode('_',$input['month']);
            $subPeriod  =   $month[0];
            $subType    =   $month[1];
            $today = date("Y-m-d");
            $date = date('Y-m-d', strtotime('+'.$subPeriod.' month', strtotime($today)));
 
	            //expert subscription entry
                $detail_update = array(
                    'payment_id' =>$request['razorpay_payment_id'], 
                    'register_amount' =>round($request['amount'], 2), 
                    'updated_at'=>  date("Y-m-d H:i:s"),
                ); 
                User::where('user_id',$request['user_id'])->update($detail_update);
			 
                //expert subscription entry
                $detail = array(
                    'payment_id' =>$request['razorpay_payment_id'],
                    'month' => $subPeriod,
                    'plan_detail' =>  $subType,
                    'register_amount' =>round($request['amount'], 2),
                    'user_id' => $request['user_id'],
                    'start_date'=>$today,
                    'end_date' => $date,
                    'payment_mode'=>config('constant.PAYMENT_MODE.ONLINE'),
                    'created_at'=>  date("Y-m-d H:i:s"),
                    'updated_at'=>  date("Y-m-d H:i:s"),
                ); 
                Subscription::create($detail);
                
                //     $user_id = $request['user_id'];
 	              //  $user_data = new Expert(User::findOrfail($user_id));
                \DB::commit();
                return $this->sendSuccess(['user_id' => $request['user_id']], 'Payment Created Successfully');
            // }
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
    public function show($user_id)
	{
		try
		{
			$user_data = User::find($user_id);
			if(isset($user_data))
			{
				$user_data = new Expert($user_data);
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
    public function update(Request $request, $user_id)
	{ 
		$error_message = 	[
			'user_image.required'       => 'Profile image should be required',
			'full_name.required' 	    => 'Full name should be required',
            'user_gender.required' 	    => 'Gender should be required',
			'user_dob.required' 	    => 'DOB should be required',
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
		];

        $rules = [
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number,'.$user_id.',user_id',
			'email_address' 	=> 'required|max:50|unique:users,email_address,'.$user_id.',user_id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'user_gender' 	    => 'required',
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
				$user_data = new Expert(User::findOrfail($user_id));
			\DB::commit();
			return $this->sendSuccess($user_data, 'Profile updated successfully');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
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

    	//expert list
	public function expertList(Request $request){ 
        try
		{    
			$expert  = User::select('users.*')
			->Where(function($query) use ($request) {  
				if (isset($request['keyword']) && !empty($request['keyword'])) { 
					$query->where('full_name','LIKE', "%".$request['keyword']."%");
					$query->orWhere('mobile_number',$request['keyword']);
					$query->orWhere('email_address','LIKE', "%".$request['keyword']."%");
					$query->orWhere('address_details','LIKE', "%".$request['keyword']."%");
				}  
			}) 
			->join('user_role','user_role.user_id','=','users.user_id')
			->Where('user_role.role_id',2)
			->orderBy('users.user_id','desc')->get();  
            $data = Experts::collection($expert);  
			if(count($data)>0){
				return $this->sendSuccess($data, 'Expert listed successfully'); 
			}else{
				return $this->sendFailed('No record found', 200); 
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

	//expert detail page
	public function expertDetail(Request $request,$id){ 
        try
		{     
			$availSlots = array();
			$reviews = array();
			$availability = array();
			$plansSpecial = array();
			
			$user_data = User::find($id);   

			if(!empty($user_data)){
				
				//feedback data
				$feedback    = Feedback::where('feedback_to',$id)->where('module_type','!=',config('constant.FEEDBACK.ORDER'))->get();
				$feedback_data    = Feedback::where('feedback_to',$id)->where('module_type',config('constant.FEEDBACK.ORDER'))->sum('rating');
				$rating = 0;
				if($feedback_data >0){
					$feedback_count = count($feedback);
					$rating = round($feedback_data/$feedback_count);       
				} 
				$reviews = Feedbacks::collection($feedback);  
 
				//personal data
				$specialPlans = explode(',',$user_data->special_plan); 
				if(count($specialPlans)>0){
					foreach($specialPlans as $plans){ 
						$plansSpecial[] = array_search($plans,config('constant.SPECIAL_PLANS'));
					} 
				}
				$infoPersonal = array( 'rating' => $rating , 'full_name' => $user_data->full_name, 'mobile_number' => $user_data->mobile_number,'email_address' => $user_data->email_address, 'user_age' => $user_data->user_age,'user_dob' => $user_data->user_dob, 'user_gender' => array_search($user_data->user_gender,config('constant.GENDER')),'country' => CommonFunction::GetSingleField('country','country_name','country_id',$user_data->country_id), 'state' => CommonFunction::GetSingleField('state','state_name','state_id',$user_data->state_id), 'city' => CommonFunction::GetSingleField('city','city_name','city_id',$user_data->city_id), 'address_details' => $user_data->address_details,'designation' => CommonFunction::GetSingleField('designation','designation_title','designation_id',$user_data->designation_id),'designation_id' => $user_data->designation_id, 'office_phone_number' => $user_data->office_phone_number,'user_experience' => $user_data->user_experience.' Years', 'licance_pic' => asset('public/expert_documents/'.$user_data->licance_pic), 'pan_card_pic' 	                => asset('public/expert_documents/'.$user_data->pan_card_pic), 'aadhar_card_pic' 	            => asset('public/expert_documents/'.$user_data->aadhar_card_pic), 'professional_certificate_pic' 	=> asset('public/expert_documents/'.$user_data->professional_certificate_pic), 'special_plan' => $plansSpecial, 'user_image' => asset('public/user_images/'.$user_data->user_image),);
				
				//availability data
				$avail_slots = Availability::where('user_id',$id)->get();
				if(count($avail_slots) >0){
                    $availSlots =  CommonFunction::getslotsData($id);
				} 
				
				//final data
				$data = array(
					'personal_details'=> $infoPersonal,
					'reviews' => $reviews,
					'availability' => $availSlots,
				);
				return $this->sendSuccess($data, 'Expert details get successfully'); 
			}else{
				return $this->sendFailed('No record found', 200); 
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
    }

}
