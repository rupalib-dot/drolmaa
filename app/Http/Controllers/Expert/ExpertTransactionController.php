<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Bookings;
use App\Models\Appointment;
use Session;
use App\Models\ExpertPayments;


class ExpertTransactionController extends Controller
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
        if($type == 'registration'){
            $transactions = $this->User->users_trans(2,'user');
            $amountearned = User::where('user_id',Session::get('user_id'))->sum('register_amount'); 
            $amountrefund = 0; 
            $totalPaidamount = 0;
            $TotalColection = $amountearned;
        }else if($type == 'appointment'){ 
            $transactions = $this->Appointment->appoinment_list_trans('expert'); 
            $amountearned = Appointment::where('expert',Session::get('user_id'))->sum('amount');
            $amountrefund = Appointment::where('expert',Session::get('user_id'))->sum('amount_refund');
            $totalPaidamount = ExpertPayments::where('user_id',Session::get('user_id'))->sum('amount');
            $TotalColection =  $amountearned -  $amountrefund ;
        }

        $data   = compact('title','request','type','transactions','amountearned','amountrefund','TotalColection','totalPaidamount');
        return view('expert_panel.trans-list', $data);
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
}
