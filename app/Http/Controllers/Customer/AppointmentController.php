<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Appointment;
use App\Models\Feedback;
use Razorpay\Api\Api;
use CommonFunction;
use App\Models\Availability;
use Session;

class AppointmentController extends Controller
{
    public function __construct()
    { 
        $this->Designation  = new Designation; 
        $this->Appointment  = new Appointment; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $title  = "Appointment"; 
    //    if ((isset($request['from_date']) && !empty($request['from_date'])) || (isset($request['to_date']) && !empty($request['to_date']))) { 
    //         if(empty($request['to_date'])){
    //             $error_message = 	[
    //                 'from_date.before'         => 'From date must be less than current date',
    //             ];

    //             $validatedData = $request->validate([
    //                 'from_date'         => 'before:date("Y-m-d")',
    //             ], $error_message);
    //         }else{  
    //             $error_message = 	[
    //                 'from_date.before'         => 'From date must be less than to date',
    //                 'to_date.after'              => 'To date must be greater than From date',
    //             ];

    //             $validatedData = $request->validate([
    //                 'from_date'         => 'before:to_date',
    //                 'to_date'         => 'after:from_date',  		 
    //             ], $error_message);
    //         }                
    //     } 
       $appointment_list   = $this->Appointment->appoinment_list(Session::get('user_id'),$request['from_date'],$request['payment_type'],$request['to_date'],$request['type']);
     
        $data   = compact('title','appointment_list','request');
        return view('customer_panel.appointment', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title  = "Make Appointment";
        $designation_list   = Designation::OrderBy('designation_title')->get(); 
        $data   = compact('title','designation_list');
        return view('customer_panel.makeappoint', $data);
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
			'name.required'         => 'Name should be required',
            'name.min'              => 'Name should be minimum of 3 characters',
            'name.max'              => 'Name should be maximum of 30 characters',
			'plan.required' 	    => 'Plan should be required',
            'designation.required'  => 'Designation should be required',
            'expert.required'       => 'Expert should be required',
            'date.required'         => 'Date should be required',
            'time.required'         => 'Time should be required',
		];

		$validatedData = $request->validate([
			'name' 	        => 'required|min:3|max:30',
			'plan' 	        => 'required',
            'designation' 	=> 'required',
            'expert' 	    => 'required',
            'date' 	        => 'required',
            'time' 	        => 'required',			 
        ], $error_message);

        
        try 
        { 
            $time_slot = explode('_',$request->time);
            $appointment_data = array(
                'name'          => $request->name,
                'user_id'          => $request->user_id,
                'plan'          => $request->plan,
                'designation'   => $request->designation,
                'payment_mode'  => config('constant.PAYMENT_MODE.ONLINE'),
                'appoinment_no' =>"AP-".rand(11111,99999), 
                'expert'        => $request->expert,
                'date'          => $request->date,
                'time'          =>$time_slot[0] , 
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ); 
            Session::put('time_slot',$time_slot[1]);
            Session::put('appointment',$appointment_data);
            
            if(Session::has('appointment')){
                return redirect()->route('appointment.confirm')->with('Success', 'Please pay fee to confirm your appointment');
            }else{
                return redirect()->back()->with('Failed', 'Something went wrong');
            } 
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->with('Failed',$e->getMessage());
        } 
    }

    public function payment_comfirm(Request $request)
    { 
        $appointment = $request->session()->get('appointment');
        $title  = "Confirm Appointment";
        $data   = compact('title','appointment');
        return view('customer_panel.appoint-confirmation',$data);
    }

    public function payment(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($request['razorpay_payment_id'])) 
        {
            try 
            { 
                $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                $appoinment     = $request->session()->get('appointment');
                $appoinment['payment_id'] = $input['razorpay_payment_id'];
                $appoinment['amount'] = round($payment['amount'], 2);
                $count_row = Appointment::create($appoinment);  
                if(!empty($count_row)){
                    Availability::where('user_id',$appoinment['expert'])->where('time',Session::get('time_slot'))->update(['status'=>config('constant.AVAIL_STATUS.BOOKED')]);
                    return redirect()->route('appointment.index')->with('Success', 'Appointment created successfully');
                }else{
                    return redirect()->back()->with('Failed', 'Something went wrong');
                }
            } 
            catch (\Throwable $e) 
            {
                return redirect()->route('expert.fourth.step')->with('Failed',$e->getMessage());
            }
        }else{
            return redirect()->route('appoinment.create')->with('Failed', 'Something went wrong');
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

    public function cancelAppoinment($id,$status)
    {
        $appoinment = Appointment::findOrfail($id);  
        $time1 = strtotime(date('Y-m-d H:i:s'));$time2 = strtotime(date('Y-m-d H:i:s',strtotime($appoinment->date.' '.$appoinment->time))); $difference = round(($time2 - $time1) / 3600);
        if($difference >= 48){   
            $refundData = CommonFunction::refundPayment($appoinment->payment_id,$appoinment->amount);
            $count_row = Appointment::where('appointment_id',$id)->update(['amount_refund'=>$refundData['amount_refund'],'refund_id'=>$refundData['id'], 'status'=>$status,'updated_at'=>date('Y-m-d H:i:s')]); 
            if(!empty($count_row)){
                if($refundData['status'] == 'success'){
                    return redirect()->route('appointment.index',['type'=>'previous'])->with('Success', $refundData['description']);
                }else{
                    return redirect()->route('appointment.index',['type'=>'previous'])->with('Failed', $refundData['description']);
                }                
            }else{
                return redirect()->back()->with('Failed', 'Something went wrong');
            }
        }else{
            return redirect()->back()->with('Failed', 'You are not allowded to cancel ');
        }
    }
 
}

 