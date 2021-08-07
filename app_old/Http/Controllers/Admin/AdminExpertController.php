<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use DB;
use App\Models\ExpertPayments;


class AdminExpertController extends Controller
{
    public function __construct()
    { 
        $this->User     = new User;  
        $this->Appointment = new Appointment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title  = "Experts";
        $experts = $this->User->total_users('2'); 
        $data   = compact('title','experts','request');
        return view('admin.expert.list', $data);
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
        $title  = "Expert Detail";
        $expert   = User::find($id); 
        $appoinment = $this->Appointment->admin_appoinment_list($id);  
        $totalamount = Appointment::where('expert',$id)->sum('amount');
        $totalPaidamount = ExpertPayments::where('user_id',$id)->sum('amount');
        $amountLeft = $totalamount - $totalPaidamount;
        $data   = compact('title','expert','appoinment','totalamount','totalPaidamount','amountLeft');
        return view('admin.expert.detail', $data);
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
