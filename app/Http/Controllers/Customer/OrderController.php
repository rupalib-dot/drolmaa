<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favourate;
use App\Models\Cart;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\OrderDetail;
use CommonFunction;
use DB;
use App\Models\Country;
use Session;

class OrderController extends Controller
{
    public function order_list(Request $request)
    {
        $title  = "Orders";
        $order = Order::where('user_id',Session::get('user_id'))->paginate(15);
        $data   = compact('title','order','request');
        return view('customer_panel.order', $data);
    } 
    
    public function order_detail(Request $request,$id)
    {
        $title  = "Order Detail";
        $order = Order::where('order_id',$id)->first();
        $orderDetail = OrderDetail::where('order_id',$id)->get();
        $data   = compact('title','order','orderDetail','request');
        return view('customer_panel.orderDetail', $data);
    }

    public function checkout(Request $request)
    {
        $title  = "Checkout";
        $country_list   = Country::OrderBy('country_name')->get();
        $totalcartamount = Cart::where('user_id',Session::get('user_id'))->sum('total_price');
        $user = User::where('user_id',Session::get('user_id'))->first();
        $data   = compact('title','totalcartamount','country_list');
        return view('customer_panel.checkout', $data);
    }
    
    public function placeOrder(Request $request){ 
        $error_message = 	[ 
			'full_name.required' 	    => 'Full name should be required',
            'user_gender.required' 	    => 'Gender should be required', 
            'country_id.required' 	    => 'Country should be required',
            'state_id.required' 	    => 'State should be required',
            'city_id.required' 	        => 'City should be required',
            'mobile_number.required' 	=> 'Mobile number should be required',
			'email_address.required' 	=> 'Email address should be required',  
			'full_name.min' 			=> 'Full name minimum :min characters',
			'full_name.max' 			=> 'Full name maximum :max characters',
			'email_address.max' 		=> 'Email address maximum :max characters',
			'email_address.regex' 		=> 'Provide valid email address', 
		];

		$validatedData = $request->validate([
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10',
			'email_address' 	=> 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',
			'user_gender' 	    => 'required',
			'country_id' 	    => 'required',
			'state_id' 	        => 'required',
			'city_id' 	        => 'required',
            'address1'   	    => 'required|min:3|max:50',
            'pincode'           => 'required|min:3|max:6',
			  
        ], $error_message);
         
        try{
            $totalcartamount = Cart::where('user_id',Session::get('user_id'))->sum('total_price');

            $data = array(
                'full_name' => $request->full_name,
                'user_gender' => $request->user_gender,
                'company_name' => $request->company_name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id, 
                'city_id' => $request->city_id,    
                'pincode' => $request->pincode,    
                'mobile_number' => $request->mobile_number,   
                'email_address' => $request->email_address,   
                'user_id' => Session::get('user_id'),   
                'grand_total' => round($totalcartamount,2),   
                'order_no'=>"DR-".rand(11111,99999), 
                'payment_type' => config('constant.PAYMENT_MODE.ONLINE'), 
                'order_status'=> config('constant.STATUS.PENDING'),
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
            );
            Session::put('order',$data);

            if(Session::has('order')){
                return redirect()->route('order.confirm')->with('Success', 'Please pay amount to confirm your Order');
            }else{
                return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
            } 
        }
        catch (\Throwable $e) 
        {
            return redirect()->back()->withInput($request->all())->with('Failed',$e->getMessage());
        } 
    }

    public function order_comfirm(Request $request)
    { 
        $order = $request->session()->get('order');
        $title  = "Confirm Order";
        $data   = compact('title','order');
        return view('customer_panel.confirmOrder',$data);
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
                $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>round($payment['amount'],2))); 
                $order     = $request->session()->get('order');
                $order['payment_id'] = $input['razorpay_payment_id'];
                $order['grand_total'] = round($payment['amount'], 2);
                $order['payment_status'] = 'paid';
                
                $dataorder = Order::create($order); 
                if($dataorder['order_id']){
                    $cart = Cart::where('user_id',Session::get('user_id'))->get(); 
                    foreach($cart as $getcart)
                    { 
                        $orderData = array(
                            'order_id' => $dataorder['order_id'],
                            'product_id' => $getcart->product_id,
                            'product_name' =>$getcart->product_name,
                            'quantity' =>$getcart->quantity,
                            'price' =>round($getcart->price,2),
                            'total_price' =>round($getcart->total_price,2),
                            'created_at' =>date('Y-m-d H:i:s'),
                            'updated_at' =>date('Y-m-d H:i:s'),
                        );
                        $orderdetail = OrderDetail::create($orderData);
                    }     
                    if(!empty($orderdetail)){
                        DB::table('cart')->where('user_id',Session::get('user_id'))->delete();
                        Session::forget('order');
                    }
                    return redirect()->route('customer.order')->with('Success', 'Order created successfully');
                }else{
                    return redirect()->back()->withInput($request->all())->with('Failed', 'Something went wrong');
                }
            } 
            catch (\Throwable $e) 
            {
                return redirect()->route('checkout')->withInput($request->all())->with('Failed',$e->getMessage());
            }
        }else{
            return redirect()->route('checkout')->withInput($request->all())->with('Failed', 'Something went wrong');
        }
    }
  
   

    public function viewcart(Request $request)
    { 
        $title  = "Cart";
        $cart = Cart::where('user_id',Session::get('user_id'))->get();
        $totalcartamount = Cart::where('user_id',Session::get('user_id'))->sum('total_price');
        $data   = compact('title','totalcartamount','cart');
        return view('customer_panel.mycart', $data);
    }

    public function addtocart(Request $request)
    { 
        $getRow = CommonFunction::GetSingleRow('products','product_id',$request['id']);
        $data=array( 
            'user_id'           => $request['userid'],
            'product_id' 	    => $request['id'], 
            'product_name'      => $getRow->product_name,
            'quantity'          => 1,
            'price'             => round($getRow->selling_price,2),
            'total_price'       => 1 * round($getRow->selling_price,2),
            'created_at' 	    => date('Y-m-d H:i:s'),
            'updated_at' 	    => date('Y-m-d H:i:s'), 
        );
        $exist = Cart::where(['user_id'=>$request['userid'],'product_id'=>$request['id']])->first();
        if(!empty($exist)){
            $qty = $exist->quantity + 1;
            $count_row = Cart::where(['user_id'=>$request['userid'],'product_id'=>$request['id']])->update(['quantity'=> $qty, 'total_price'=> $qty * round($getRow->selling_price,2)]); 
        }else{
            $count_row = Cart::create($data);  
        } 
        if(!empty($count_row)){
            return Response()->json([
               "success" => true,
               "message" =>'Item added to cart successfully',
           ]); 
       }else{ 
           return Response()->json([
               "success" => false,
               "message" => 'Something went wrong',
           ]);
       }
    }
 
    public function addtofavourate(Request $request)
    { 
       
        $data=array( 
            'user_id'           => $request['userid'],
            'product_id' 	    => $request['id'], 
            'created_at' 	    => date('Y-m-d H:i:s'),
            'updated_at' 	    => date('Y-m-d H:i:s'), 
        );
        $msg = "Product added to favourites successfully";
        
        $exist = Favourate::where(['user_id'=>$request['userid'],'product_id'=>$request['id']])->first();
        if(!empty($exist)){
            $count_row = DB::table('favourate')->where(['user_id'=>$request['userid'],'product_id'=>$request['id']])->delete(); 
            $msg = "Product added to favourites successfully";
        }else{
            $count_row = Favourate::create($data);  
            $msg = "Product added to favourites successfully";
        } 
        if(!empty($count_row)){
            return Response()->json([
               "success" => true,
               "message" =>$msg,
           ]); 
       }else{ 
           return Response()->json([
               "success" => false,
               "message" => 'Something went wrong',
           ]);
       }
    }

    public function updateCartQty(Request $request)
    {  
        $getRow = CommonFunction::GetSingleRow('products','product_id',$request['pid']); 
        $exist = Cart::where(['user_id'=>$request['userid'],'product_id'=>$request['pid']])->first();
        $qty = 1;
        if($request['type'] == 'sub'){
            $qty = $exist->quantity - 1;
        }else if($request['type'] == 'add'){
            $qty = $exist->quantity + 1;
        } 
        $count_row = Cart::where(['user_id'=>$request['userid'],'product_id'=>$request['pid']])->update(['quantity'=> $qty, 'total_price'=> $qty * round($getRow->selling_price,2)]); 
         
        if(!empty($count_row)){
            return Response()->json([
               "success" => true,
               "message" =>'Item quantity updated successfully',
           ]); 
       }else{ 
           return Response()->json([
               "success" => false,
               "message" => 'Something went wrong',
           ]);
       }
    }

    
    public function deletecartItem(Request $request,$id,$delType)
    {  
        if($delType == 'all'){
            $count_row = DB::table('cart')->where(['user_id'=>$id])->delete();
        }else{
            $count_row = DB::table('cart')->where(['cart_id'=>$id])->delete();
        }
        if(!empty($count_row)){
            return redirect()->back()->with('Success', 'cart updated successfully');
        }else{
            return redirect()->back()->with('Failed', 'Something went wrong');
        } 
    }
}
