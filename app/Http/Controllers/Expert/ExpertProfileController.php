<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Session;

class ExpertProfileController extends Controller
{
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
        //
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
    public function edit($user_id)
    {
        $record_data    = User::findOrfail($user_id);
        $country_list   = Country::OrderBy('country_name')->get();
        $title          = "Profile";
        $data           = compact('title','record_data','country_list');
        return view('expert_panel.profile', $data);
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

		$validatedData = $request->validate([
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number,'.$user_id.',user_id',
			'email_address' 	=> 'required|max:50|unique:users,email_address,'.$user_id.',user_id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'user_gender' 	    => 'required',
			'city_id' 	        => 'required',
			'user_dob' 	        => 'required',
        ], $error_message);

        $user_data = array(
            'full_name'     => $request->full_name,
            'mobile_number' => $request->mobile_number,
            'user_gender'   => $request->user_gender,
            'country_id'    => $request->country_id,
            'state_id'      => $request->state_id,
            'city_id'       => $request->city_id,
            'user_dob'      => $request->user_dob,
        );
        $count_row = User::where('user_id',$user_id)->update($user_data);
        return redirect()->back()->with('Success', 'Profile updated successfully');
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

    public function change_password()
    { 
        $title  = "Change Password";
        $data   = compact('title');
        return view('expert_panel.change-password', $data);
    }

}
