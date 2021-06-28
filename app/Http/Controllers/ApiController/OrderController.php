<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Validator;
use App\Http\Controllers\ApiController\BaseController as BaseController;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Resources\Order as OrderArtical;

class OrderController extends BaseController
{
	public function __construct() 
	{
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
	
	public function index(Request $request)
	{
        $error_message = 	[
			'user_id.required'       => 'User id should be required',
		];

        $validatedData = [
			'user_id' 	        => 'required',
		];

		$validator = Validator::make($request->all(), $validatedData, $error_message);
   
        if($validator->fails()){
            return $this->sendFailed($validator->errors()->all(), 200);       
        }
		try
		{
			$record_data = Order::where('user_id', $request->user_id)->get();
			if(count($record_data) > 0)
			{
				$record_data = OrderArtical::collection($record_data);
				return $this->sendSuccess($record_data, 'Order listed successfully');
			}
			else
			{
				return $this->sendFailed('Order not found',200);  
			}
		}
		catch (\Throwable $e)
    	{
    		return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
    	}

	}

    public function store(Request $request)
    {
        try
        {
            $order_data 	= json_decode($request->order_data, true);
			\DB::beginTransaction();
                $order_hd = new Order();
                $order_hd->user_id		    = $order_data['user_id'];
                $order_hd->full_name		= $order_data['full_name'];
                $order_hd->user_gender 	    = $order_data['user_gender'];
                $order_hd->company_name 	= $order_data['company_name'];
                $order_hd->address1	        = $order_data['address1'];
                $order_hd->address2 	    = $order_data['address2'];
                $order_hd->country_id 		= $order_data['country_id'];
                $order_hd->state_id 	    = $order_data['state_id'];
                $order_hd->city_id 		    = $order_data['city_id'];
                $order_hd->pincode 			= $order_data['pincode'];
                $order_hd->mobile_number 	= $order_data['mobile_number'];
                $order_hd->email_address 	= $order_data['email_address'];
                $order_hd->grand_total 	    = $order_data['grand_total'];
                $order_hd->order_no 		= $order_data['order_no'];
                $order_hd->payment_id 		= $order_data['payment_id'];
                $order_hd->payment_type 	= config('constant.PAYMENT_MODE.ONLINE');
                $order_hd->payment_status 	= 'paid';
                $order_hd->order_status 	= config('constant.STATUS.PENDING');
                $order_hd->save();

				foreach($order_data['product_list'] as $product_list)
				{
					$order_dt = new OrderDetail;
					$order_dt->order_id 	= $order_hd->order_id;
					$order_dt->product_id 	= $product_list['product_id'];
					$order_dt->product_name = $product_list['product_name'];
					$order_dt->quantity 	= $product_list['quantity'];
					$order_dt->price 		= $product_list['price'];
					$order_dt->total_price 	= $product_list['price'] * $product_list['quantity'];
					$order_dt->save();
				}
            \DB::commit();
			$record_data = OrderArtical::collection(Order::where('user_id', $order_data['user_id'])->get());
			return $this->sendSuccess($record_data, 'Order placed successfully');
        }
        catch (\Throwable $e) 
        {
            \DB::rollback();
            return $this->sendFailed($e->getMessage().' on line '.$e->getLine(), 400);  
        }
    }
}