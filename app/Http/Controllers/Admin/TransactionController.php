<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Bookings;
use App\Models\Subscription;
use DB;
use App\Models\Appointment;
use App\Models\ExpertPayments;



class TransactionController extends Controller
{
    public function __construct()
    { 
        $this->Bookings     = new Bookings; 
        $this->User     = new User; 
        $this->Appointment     = new Appointment; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$type)
    { 
        $title  = $type." transactions";  
        if($type == 'order'){ 
            $transactions = Order::orderBy('order_id','desc')->paginate(15);
            $amountearned = Order::sum('grand_total');
            $amountrefund = Order::sum('refund_amount');
            $TotalColection = $amountearned -  $amountrefund ;
            $totalPaidamount = 0;
        }else if($type == 'registration'){
            $transactions    = Subscription::orderBy('subscription_id','desc')->paginate(15);
            $amountearned = Subscription::sum('register_amount');  
            $amountrefund = 0;
            $TotalColection = $amountearned;
            $totalPaidamount = 0;
        }else if($type == 'booking'){
            $transactions = $this->Bookings->UsersBookings('admin'); 
            $amountearned =  $this->Bookings->UsersBookingsTotal('admin'); 
            $amountrefund = 0;
            $TotalColection = $amountearned;
            $totalPaidamount = 0;
        }else if($type == 'appointment'){ 
            $totalPaidamount = ExpertPayments::sum('amount');
            $transactions = $this->Appointment->appoinment_list_trans('admin'); 
            $amountearned = Appointment::sum('amount');
            $amountrefund = Appointment::sum('amount_refund');
            $TotalColection =  $amountearned -  $amountrefund ;
        }

        $data   = compact('title','request','type','transactions','amountearned','amountrefund','TotalColection','totalPaidamount');
        return view('admin.transactions.list', $data);
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

    public function payexpert(Request $request)
    {  
        $error_message = 	[
			'payment_mode.required'         => 'Payment mode should be required', 
			'transaction_id.required' 	    => 'Transaction id should be required',
            'amount.required'               => 'Amount should be required',
            'transaction_date.required'     => 'Transaction Date should be required', 
		];

		$validatedData = $request->validate([
			'payment_mode' 	        => 'required',
			'transaction_id' 	    => 'required',
            'amount' 	            => 'required',
            'transaction_date' 	    => 'required', 
        ], $error_message);

        
        try  {
            $pay_data = array( 
                'user_id'               => $request->userid,
                'transaction_id'        => $request->transaction_id,
                'transaction_date'      => $request->transaction_date,
                'payment_mode'          => $request->payment_mode,
                'amount'                => $request->amount, 
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
            ); 
            $id = ExpertPayments::create($pay_data);
            
            if(!empty($id)){
                return Response()->json([
                    "success" => true,
                    "message" => 'Amount Paid Successfully',
                ]); 
            }else{ 
                return Response()->json([
                    "success" => false,
                    "message" => 'Something went wrong',
                ]);
            }
        }
        catch (\Throwable $e) 
        {
            return Response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);  
        } 
    }

    public function payDetails(Request $request){
        $title  = "Amount paid to Expert";  
        $totalPaidamount = ExpertPayments::sum('amount');
        $expertPayment = ExpertPayments::orderBy('expert_payment_id','desc')->paginate(15); 
        $data   = compact('title','request','expertPayment','totalPaidamount');
        return view('admin.transactions.expert_payments', $data);
    }
}
