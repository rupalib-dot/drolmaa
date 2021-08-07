<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use App\Models\UserRole;
use App\Http\Resources\City As ArticalCity;
use Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->Country  = new Country;
        $this->User     = new User;
        $this->UserRole = new UserRole;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $country_list   = Country::OrderBy('country_name')->get();
        $title      = 'Customer Registration';
        $data       = compact('title','country_list');
        return view('customer_panel.client_register',$data);
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

		$validatedData = $request->validate([
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
            'nTerms'		    => 'accepted',
        ], $error_message);

        try
        {
            \DB::beginTransaction();
                $user = new User;
                $user->full_name        = $request->full_name;
                $user->user_gender      = $request->user_gender;
                $user->user_dob         = $request->user_dob;
                $user->country_id       = $request->country_id;
                $user->state_id         = $request->state_id;
                $user->city_id          = $request->city_id;
                $user->mobile_number    = $request->mobile_number;
                $user->email_address    = $request->email_address;
                $user->user_password    = md5($request->user_password);
                $user->save();

                $user_role = new UserRole;
                $user_role->role_id = 3;
                $user_role->user_id = $user->user_id;
                $user_role->save();
            \DB::commit();

             //mail to new user
             $details = array(
                'name'         => $request->full_name,
                'mobile' 		=>  $request->mobile_number,
                'email' 		=> $request->email_address,   
                'password'      => $request->user_password,
                'user_id'       => $user->user_id,
            );   
            \Mail::to($request->email_address)->send(new \App\Mail\NewUserMail($details));

            return redirect()->route('login')->with('Success', 'Account created successfully, Check your email inbox to verify your email...');  
        }
        catch (\Throwable $e)
    	{
            \DB::rollback();
    		return redirect()->route('customer.create')->with('Failed', $e->getMessage())->withInput();  
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
}
