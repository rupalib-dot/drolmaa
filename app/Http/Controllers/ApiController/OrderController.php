<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Order;
use App\Models\Coupons;
use App\Models\User;
use Validator;
use App\Models\OrderDetail;
use App\Http\Resources\Order as Orders;
use CommonFunction;
use App\Http\Resources\OrderDetail as OrdersDetail; 



class OrderController extends  BaseController
{
    public function __construct() 
	{
        $this->User = new User;

        //header("Content-Type: application/json");
		$valid_passwords = array ("drolmaa" => "026866326a9d1d2b23226e4e5317569f");
		$valid_users = array_keys($valid_passwords);

		$user = request()->server('PHP_AUTH_USER');
		$pass = request()->server('PHP_AUTH_PW');

		$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

		if (!$validated) {
		  header('WWW-Authenticate: Basic realm="My Realm"');
		  header('HTTP/1.0 401 Unauthorized');
		  $re = array(
		  	"status" 	=> false,
		  	"message"	=> "You're not authorized to access."
		  );
		  echo json_encode($re, JSON_PRETTY_PRINT);
		  die;
		}
		
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$user_id)
    {
        try
		{  
			$orders = Order::where('user_id',$user_id)->orderBy('order_id','desc')->get();  
            $data = Orders::collection($orders);  
            return $this->sendSuccess($data, 'Orders listed successfully'); 
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	} 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        try
		{
			$order_data 	= json_decode($request->order_data, true);
			$order_data		= $order_data['order_data'];
			\DB::beginTransaction();    
 
				$order = new Order();
				$order->full_name		    = $order_data['full_name'];
				$order->company_name		= $order_data['company_name'];
				$order->address1 	        = $order_data['address1'];
				$order->address2 		    = $order_data['address2'];
				$order->pincode	            = $order_data['pincode'];
				$order->mobile_number 	    = $order_data['mobile_number']; 
				$order->email_address 		= $order_data['email_address'];
				$order->user_id 	        = $order_data['user_id'];
				$order->grand_total 		=  round($order_data['grand_total'],2); 
				$order->order_no 			= "DR-".rand(11111,99999); 
                $order->order_status 	    = config('constant.STATUS.PENDING');
				$order->coupon_id 		    = empty($order_data['coupon_id']) ? NULL : $order_data['coupon_id'];
				$order->coupon_code 		= $order_data['coupon_code'];  
                $order->comment             = $order_data['comment'];
                $order->discount            = $order_data['discount'];
                $order->orignal_grand_total = round(((float)$order_data['grand_total'] + (float)$order_data['discount']),2);
				$order->save(); 

				foreach($order_data['product_list'] as $product_list)
				{
					$order_dt = new OrderDetail;
					$order_dt->order_id 		= $order->order_id;
					$order_dt->product_id 		= $product_list['product_id'];
					$order_dt->product_name 	= $product_list['product_name'];
					$order_dt->quantity 		= $product_list['quantity'];
					$order_dt->price 		    = round($product_list['price'],2);
					$order_dt->total_price 		= round(($product_list['price'] * $product_list['quantity']),2); 
					$order_dt->save();
				}
			\DB::commit();
			
			return $this->sendSuccess(['order_id'=>$order->order_id], 'Order placed successfully');
		}
		catch (\Throwable $e)
    	{
            \DB::rollback();
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
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

    public function changeOrderStatus(Request $request,$order_id,$status)
    {  
        
        $count_row = Order::where(['order_id'=>$order_id])->update(['order_status'=>$status]); 
        $msg = 'Order '.strtolower(array_search($status,config('constant.STATUS'))).' successfully';

        if($status == config('constant.STATUS.CANCELLED')){
            $order = Order::find($order_id);  
            $refundData = CommonFunction::refundPayment($order->payment_id ,$order->grand_total,'Order');  
            $count_row = Order::where(['order_id'=>$order_id])->update(['refund_amount'=>$refundData['amount_refund'],'refund_id'=>$refundData['id'], 'refund_status'=>'refund '.$refundData['status'],'updated_at'=>date('Y-m-d H:i:s')]);
            $msg = $refundData['description']; 
        } 

        if(!empty($count_row)){  
            $order = Order::find($order_id); 
            $data = new Orders($order); 
			return $this->sendSuccess($data, $msg);
		}else{ 
    		return $this->sendFailed('Something went wrong', 200);  
    	} 
    }

    public function ApplyCoupon(Request $request)
	{ 
		$validator = Validator::make($request->all(), [
			'coupon_code'   	=> 'required',
			'order_amount'   	=> 'required',
		], [
			'coupon_code.required'   	=> 'Coupon code is required',
			'order_amount.required'   	=> 'Order amount is required',
		]);

        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }

		try
		{
			$coupon_data = Coupons::where('coupon_code',$request->coupon_code)->first();
			if(isset($coupon_data))
			{ 
                $discount_amount = number_format(($request->order_amount * $coupon_data->discount) / 100);
                $data = ['coupon_code'=>$coupon_data->coupon_code,'coupon_id'=>$coupon_data->coupon_id,'discount'=>  $discount_amount,'amount_with_discount'=> ($request->order_amount -  $discount_amount),'amount_without_discount'=> $request->order_amount];
                return $this->sendSuccess($data, 'Coupon applied successfully');
				 
			}
			else
			{
				return $this->sendFailed('Invalid coupon code',200);
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}
	}
}
