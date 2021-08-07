<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use CommonFunction;
use App\Models\Feedback;
use App\Models\OrderDetail;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title  = "Orders";
        $order = Order::orderBy('order_id','desc')->paginate(15);
        $data   = compact('title','order','request');
        return view('admin.order.list', $data);
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
    public function show(Request $request,$id)
    {
        $title  = "Order Detail";
        $order = Order::where('order_id',$id)->first();
        $orderDetail = OrderDetail::where('order_id',$id)->get();
        $feedback_list   = Feedback::where(['module_id'=>$id,'module_type'=>config('constant.FEEDBACK.ORDER')])->orderBy('feedback_id','desc')->get();
        $data   = compact('title','order','orderDetail','feedback_list','request');
        return view('admin.order.detail', $data);
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

    public function changeOrderStatus(Request $request)
    {  
        $count_row = Order::where(['order_id'=>$request['id']])->update(['order_status'=>$request['status']]); 
        $msg = "Order status updated successfully";

        if($request['status'] == config('constant.STATUS.CANCELLED')){
            $order = Order::findOrfail($request['id']); 
            $refundData = CommonFunction::refundPayment($order->payment_id ,$order->grand_total,'Order'); 
            $count_row = Order::where(['order_id'=>$request['id']])->update(['refund_amount'=>$refundData['amount_refund'],'refund_id'=>$refundData['id'], 'refund_status'=>'refund '.$refundData['status'],'updated_at'=>date('Y-m-d H:i:s')]);
            $msg = $refundData['description']; 
        }
         
        if(!empty($count_row)){ 
            return redirect()->back()->with('Success', $msg);
        }else{
            return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
        } 
    }
}
