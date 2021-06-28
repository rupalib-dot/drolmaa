<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Workshop;
use Razorpay\Api\Api;
use Session;

class BookingController extends Controller
{
    public function __construct()
    { 
        $this->Bookings  = new Bookings;  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title  = "Bookings";
        $booking_list   = $this->Bookings->booking_list(Session::get('user_id'),$request['from_date'],$request['to_date']);
        $data   = compact('title','booking_list','request');
        return view('customer_panel.booking', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $title  = "Make Booking";
        $workshop_list   = Workshop::OrderBy('title')->where('date','>',date('Y-m-d'))->get(); 
        $data   = compact('title','workshop_list');
        return view('customer_panel.makebooking', $data);
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
			'module_id.required'         => 'Workshop should be required', 
		];

		$validatedData = $request->validate([
			'module_id' 	        => 'required', 		 
        ], $error_message);

        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($request['razorpay_payment_id'])) 
        {
            try 
            { 
                $bookingExist = Bookings::where('user_id',Session::get('user_id'))->where('module_id',$request->module_id)->first();
                if(empty($bookingExist)){ 
                    $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                    $booking_data = Bookings::create([ 
                        'user_id'       => Session::get('user_id'),
                        'booking_no' =>"BOO-".rand(11111,99999), 
                        'module_id'          => $request->module_id,
                        'module_type'   => $request->module_type,
                        'status'  => config('constant.STATUS.ACCEPTED'),
                        'payment_mode'        => config('constant.PAYMENT_MODE.ONLINE'), 
                        'payment_id'        => $input['razorpay_payment_id'], 
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]); 
                    
                    if($booking_data){
                        return redirect()->route('bookings.index')->with('Success', 'Booking created successfully');
                    }else{
                        return redirect()->back()->with('Failed', 'Something went wrong');
                    } 
                }else{
                    return redirect()->back()->withInput($request->all())->with('Failed', 'You have alerady booked this workshop');
                } 
            }
            catch (\Throwable $e) 
            {
                return redirect()->back()->with('Failed',$e->getMessage());
            } 
        }else{
            return redirect()->back()->with('Failed', 'Something went wrong');
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
