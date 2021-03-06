<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Designation;
use App\Models\UserRole;
use Session;
use Razorpay\Api\Api;

class ExpertController extends Controller
{
    public function __construct()
    {
        $this->User         = new User;
        $this->Country      = new Country;
        $this->Designation  = new Designation;
        $this->UserRole     = new UserRole;
    }
    
    public function expert_personal(Request $request)
    {
        $expert         = $request->session()->get('expert');
        $country_list   = Country::OrderBy('country_name')->get();
        $title          = "Personal Details";
        $data           = compact('title','country_list','expert');
        return view('expert_panel.expert_register.step_first', $data);
    }

    public function expert_personal_post(Request $request)
    {
        $expert         = $request->session()->get('expert');
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
		];

		$validatedData = $request->validate([
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number',
			'email_address' 	=> 'required|max:50|unique:users,email_address',
			'user_age' 	        => 'required|integer|digits_between: 1,100',
			'user_gender' 	    => 'required',
			'country_id' 	    => 'required',
			'state_id' 	        => 'required',
			'city_id' 	        => 'required',
			'address_details' 	=> 'required|max:150',
            'user_password'		=> 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'	=> 'required|required_with:user_password|same:user_password',
        ], $error_message);

        if(!isset($request->session()->get('expert')->user_image) || !empty($request->file('user_image')))
        {
            $validatedData[] = $request->validate([
                'user_image' 	    => 'required|mimes:jpeg,jpg,png',
            ], $error_message);

            $fileName = time() . '.' . $request->file('user_image')->getClientOriginalExtension();
            $request->file('user_image')->move(public_path('user_images'), $fileName);
        }
        else
        {
            $fileName = $request->session()->get('expert')->user_image;
        }

        if(empty($request->session()->get('expert')))
        {
            $expert = new User();
            $expert->user_password    = md5($request->user_password);
            $expert->fill($validatedData); 
            $request->session()->put('expert', $expert);
        }
        else
        {
            $expert = $request->session()->get('expert');
            $expert->user_password    = md5($request->user_password);
            $expert->fill($validatedData);
            $request->session()->put('expert', $expert);
        }
        $expert = $request->session()->get('expert');  
        $expert->user_image = $fileName;
        return redirect()->route('expert.second.step');
    }

    public function expert_professional(Request $request)
    {
        if(empty($request->session()->get('expert')))
        {
            return redirect()->route('expert.first.step');
        }

        $expert             = $request->session()->get('expert');
        $designation_list   = Designation::OrderBy('designation_title')->get();
        $title              = "Professional Details";
        $data               = compact('title','designation_list','expert');
        return view('expert_panel.expert_register.step_second', $data);
    }

    public function expert_professional_post(Request $request)
    {
        $error_message = 	[
			'designation_id.required'       => 'Designation should be required',
			'user_experience.required' 	    => 'Experience should be required',
			'digits' 	                    => 'Phone number shoud be :digits digits',
		];

		$validatedData = $request->validate([
			'designation_id' 	    => 'required',
			'office_phone_number' 	=> 'required|digits:10',
			'user_experience' 	    => 'required',
        ], $error_message); 

        $expert = $request->session()->get('expert');
        if(!empty($request->special_plan)){
            $expert->special_plan = implode(',',$request->special_plan);
        }else{
            $expert->special_plan = "";
        }
        $expert = $request->session()->get('expert');
        $expert->fill($validatedData);
        $request->session()->put('expert', $expert);

        return redirect()->route('expert.third.step');
    }

    public function expert_documents(Request $request)
    {
        if(!isset($request->session()->get('expert')->designation_id))
        {
            return redirect()->route('expert.second.step');
        }
        $title          = "Documents Details";
        $data           = compact('title');
        return view('expert_panel.expert_register.step_third', $data);
    }

    public function expert_documents_post(Request $request)
    {
        if(!isset($request->session()->get('expert')->licance_pic))
        {
            $error_message = 	[
                'licance_pic.required'                  => 'Professional license should be required',
                'pan_card_pic.required' 	            => 'PAN card should be required',
                'aadhar_card_pic.required' 	            => 'Aadhar card should be required',
                'professional_certificate_pic.required' => 'Professional certificate should be required',
                'mimes' 	                            => 'All documents should be jpeg, jpg, png format',
            ];

            $validatedData = $request->validate([
                'licance_pic' 	                => 'required|mimes:jpeg,jpg,png',
                'pan_card_pic' 	                => 'required|mimes:jpeg,jpg,png',
                'aadhar_card_pic' 	            => 'required|mimes:jpeg,jpg,png',
                'professional_certificate_pic' 	=> 'required|mimes:jpeg,jpg,png',
            ], $error_message); 

            $licance_pic = 'licance_pic_' . time() . '.' . $request->file('licance_pic')->getClientOriginalExtension();
            $request->file('licance_pic')->move(public_path('expert_documents'), $licance_pic);

            $pan_card_pic = 'pan_card_pic_' . time() . '.' . $request->file('pan_card_pic')->getClientOriginalExtension();
            $request->file('pan_card_pic')->move(public_path('expert_documents'), $pan_card_pic);

            $aadhar_card_pic = 'aadhar_card_pic_' . time() . '.' . $request->file('aadhar_card_pic')->getClientOriginalExtension();
            $request->file('aadhar_card_pic')->move(public_path('expert_documents'), $aadhar_card_pic);

            $professional_certificate_pic = 'professional_certificate_pic_' . time() . '.' . $request->file('professional_certificate_pic')->getClientOriginalExtension();
            $request->file('professional_certificate_pic')->move(public_path('expert_documents'), $professional_certificate_pic);

            $expert = $request->session()->get('expert');
            $expert->licance_pic                    = $licance_pic;
            $expert->pan_card_pic                   = $pan_card_pic;
            $expert->aadhar_card_pic                = $aadhar_card_pic;
            $expert->professional_certificate_pic   = $professional_certificate_pic;
        }
        $expert = $request->session()->get('expert');
        return redirect()->route('expert.fourth.step');
    }

    public function expert_plan(Request $request)
    {
        if(!isset($request->session()->get('expert')->licance_pic))
        {
            return redirect()->route('expert.third.step');
        }
        $expert = $request->session()->get('expert');
        $title  = "Plan Details";
        $data   = compact('title','expert');
        return view('expert_panel.expert_register.step_fourth', $data);
    }

    public function expert_plan_post(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($request['razorpay_payment_id'])) 
        {
            try 
            {
                $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                $expert     = $request->session()->get('expert');
                $expert->save();

                $user_data = User::Where('mobile_number',$expert->mobile_number)->first('user_id');
                Session()->flush();

                $user_role = new UserRole;
                $user_role->role_id = 2;
                $user_role->user_id = $user_data->user_id;
                $user_role->save();

                return redirect()->route('login')->with('Success', 'Account created successfully, Check your email inbox to verify your email...');
            } 
            catch (\Throwable $e) 
            {
                return redirect()->route('expert.fourth.step')->with('Failed',$e->getMessage());
            }
        }
    }
}
