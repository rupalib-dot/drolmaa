<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingController extends Controller
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
    public function edit($id)
    {
        $title  = "Settings";
        $settings = Settings::find($id);  
        $data   = compact('title','settings');
        return view('admin.settings', $data);
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
        $error_message = 	[ 
			'contact_name.required' 	    => 'Contact name should be required',
            'contact_name.min' 			=> 'Contact name minimum :min characters',
			'contact_name.max' 			=> 'Contact name maximum :max characters',
            'contact_email.required' 	=> 'Contact Email should be required',
            'contact_email.max' 		=> 'Contact Email maximum :max characters',
			'contact_email.regex' 		=> 'Provide valid email address', 
            'contact_address.required' 	=> 'Contact address should be required',
            'contact_address.min' 		=> 'Contact address minimum :min characters',
			'contact_address.max' 	    => 'Contact address maximum :max characters',
            'contact_no.required' 	    => 'Contact number should be required',
            'aleternate_no.required' 	=> 'Contact number should be required', 
            'terms_condition.required' 	=> 'Terms and Condition should be required',
			'about_us.required' 	    => 'About us should be required',
            'privacy.required' 	        => 'Privacy should be required',  
		];

		$validatedData = $request->validate([
			'contact_name' 	    => 'required|min:3|max:30',
            'contact_address'   => 'required|min:3|max:150',
			'contact_no' 	    => 'required|digits:10',
			'contact_email' 	=> 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'aleternate_no' 	=> 'required|digits:10',
            'terms_condition' 	=> 'required',
			'about_us' 	        => 'required',
			'privacy' 	        => 'required',
        ], $error_message);

        $setting_data = array(
            'terms_condition'       => $request->terms_condition,
            'about_us'              => $request->about_us,
            'privacy'               => $request->privacy,
            'contact_no'            => $request->contact_no,
            'contact_email'         => $request->contact_email,
            'contact_name'          => $request->contact_name,
            'aleternate_no'         => $request->aleternate_no,
            'contact_address'       => $request->contact_address,
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s')
        );
        $count_row = Settings::where('setting_id',$id)->update($setting_data);
        if(!empty($count_row)){
            return redirect()->back()->with('Success', 'Settings updated successfully');
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
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
}
