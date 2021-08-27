<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation; 
use App\Models\Country;
use App\Models\Subscription;
use Razorpay\Api\Api;
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

    public function dashboard()
    {
        $title          = "Dashboard";
        $data           = compact('title');
        return view('expert_panel.dashboard', $data);
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
        $designation_list   = Designation::OrderBy('designation_title')->get();
        $subscription_data    = Subscription::where('user_id',$user_id)->orderBy('subscription_id','desc')->first();
        $country_list         = Country::OrderBy('country_name')->get();
        $title                = "Profile";
        $data                 = compact('title','record_data','designation_list','country_list','subscription_data');
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
            'designation_id.required'       => 'Designation should be required',
			'user_experience.required' 	    => 'Experience should be required',
			'digits' 	                    => 'Phone number shoud be :digits digits',
		];

		$validatedData = $request->validate([
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10|unique:users,mobile_number,'.$user_id.',user_id',
			'email_address' 	=> 'required|max:50|unique:users,email_address,'.$user_id.',user_id|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'user_gender' 	    => 'required',
			'city_id' 	        => 'required',
			'user_dob' 	        => 'required',
            'designation_id' 	    => 'required',
			'office_phone_number' 	=> 'required|digits:10',
			'user_experience' 	    => 'required',
        ], $error_message);

        if($request->special_plan == ''){
            return redirect()->back()->withInput($request->all())->with('Failed','Plan must not be empty');
        }
        if(count($request->special_plan)>2){
            return redirect()->back()->withInput($request->all())->with('Failed','Select only 2 Plan');
        }

        if(!empty($request->special_plan) && count($request->special_plan)){
            $special_plan = implode(',',$request->special_plan);
        }else{
            $special_plan = "";
        }
        $user_data = array(
            'full_name'     => $request->full_name,
            'mobile_number' => $request->mobile_number,
            'user_gender'   => $request->user_gender,
            'country_id'    => $request->country_id,
            'state_id'      => $request->state_id,
            'city_id'       => $request->city_id,
            'user_dob'      => $request->user_dob, 
            'designation_id'    => $request->designation_id,
            'office_phone_number'      => $request->office_phone_number,
            'user_experience'       => $request->user_experience,
            'description'      => $request->description, 
            'special_plan'     => $special_plan,
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

    public function subscribe(Request $request)
    { 
        $input = $request->all();
        $month      =   explode('_',$input['month']);
        $subPeriod  =   $month[0];
        $subType    =   $month[1];
        $today = date("Y-m-d");
        $date = date('Y-m-d', strtotime('+'.$subPeriod.' month', strtotime($today)));


        $api = new Api("rzp_test_tazXyaYClLVzyb", "QcFkC78PT0dkVGsPO8FWVMNB");
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($request['razorpay_payment_id'])) 
        {
            try{
                $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                  
                //expert subscription entry
                $detail_update = array(
                    'payment_id' =>$request['razorpay_payment_id'], 
                    'register_amount' =>substr(round($payment['amount'], 2) , 0, -2),
                    'updated_at'=>  date("Y-m-d H:i:s"),
                ); 
                User::where('user_id',$input['user_id'])->update($detail_update);

                //expert subscription entry
                $detail = array(
                    'payment_id' =>$request['razorpay_payment_id'],
                    'month' => $subPeriod,
                    'plan_detail' =>  $subType,
                    'register_amount' =>substr(round($payment['amount'], 2) , 0, -2),
                    'user_id' => $input['user_id'],
                    'start_date'=>$today,
                    'end_date' => $date,
                    'payment_mode'=>config('constant.PAYMENT_MODE.ONLINE'),
                    'created_at'=>  date("Y-m-d H:i:s"),
                    'updated_at'=>  date("Y-m-d H:i:s"),
                );
                Subscription::create($detail);
 
                return redirect()->back()->with('Success', 'Your '.$month,' month subscription plan has renewed successfully');
            } 
            catch (\Throwable $e) 
            {
                return redirect()->back()->with('Failed',$e->getMessage());
            }
        }
    }
}
