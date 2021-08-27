<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favourate;
use App\Models\Cart;
use App\Models\Coupons;
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
        $order = Order::where('user_id',Session::get('user_id'))->orderBy('order_id','desc')->paginate(15);
        $data   = compact('title','order','request');
        return view('orders.order', $data);
    } 
    
    public function applyCoupon(Request $request){ 
        $coupon_data = Coupons::where('coupon_code',$request->code)->first();
        if(isset($coupon_data))
        { 
            $discount_amount = number_format(($request->order_amount * $coupon_data->discount) / 100);
            $amount_with_discount = $request->order_amount -  $discount_amount;
            
            $request->session()->put('coupon_code',$coupon_data->coupon_code);
            $request->session()->put('coupon_id',$coupon_data->coupon_id);
            $request->session()->put('discount', $discount_amount);
            $request->session()->put('amount_with_discount',$amount_with_discount);
            $request->session()->put('amount_without_discount', $request->order_amount); 
            return Response()->json([
               "success" => true,
               "message" =>'Discount applied successfully',
            ]);           
       }else{ 
           return Response()->json([
               "success" => false,
               "message" => "This coupon code does't exist",
           ]);
       }   
    }

    public function order_detail(Request $request,$id)
    {
        $title  = "Order Detail";
        $order = Order::where('order_id',$id)->first();
        $orderDetail = OrderDetail::where('order_id',$id)->get();
        $data   = compact('title','order','orderDetail','request');
        return view('orders.orderDetail', $data);
    }

    public function checkout(Request $request)
    {
        $title  = "Checkout";
        $country_list   = Country::OrderBy('country_name')->get();
        $totalcartamount = Cart::where('user_id',Session::get('user_id'))->sum('total_price');
        $user = User::where('user_id',Session::get('user_id'))->first();
        $data   = compact('title','totalcartamount','country_list');
        return view('orders.checkout', $data);
    }
    
    public function placeOrder(Request $request){ 
        $error_message = 	[ 
			'full_name.required' 	    => 'Full name should be required', 
            'mobile_number.required' 	=> 'Mobile number should be required',
			'email_address.required' 	=> 'Email address should be required',  
			'full_name.min' 			=> 'Full name minimum :min characters',
			'full_name.max' 			=> 'Full name maximum :max characters',
			'email_address.max' 		=> 'Email address maximum :max characters',
			'email_address.regex' 		=> 'Provide valid email address', 
            'address2.required'         => 'Address must not be empty',

		];

		$validatedData = $request->validate([
			'full_name' 	    => 'required|min:3|max:30',
			'mobile_number' 	=> 'required|digits:10',
			'email_address' 	=> 'required|max:50|regex:^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',  
            'address2'   	    => 'required|min:3|max:250',
			  
        ], $error_message);
         
        try{ 

            $totalcartamount = Cart::where('user_id',Session::get('user_id'))->sum('total_price');

            $data = array(
                'full_name' => $request->full_name, 
                'address1' => $request->address1,
                'address2' => $request->address2, 
                'mobile_number' => $request->mobile_number,   
                'email_address' => $request->email_address,   
                'user_id' => Session::get('user_id'),   
                'grand_total' => round(Session::get('amount_with_discount'),2), 
                'orignal_grand_total' => round($totalcartamount,2),   
                'coupon_id' 		    => Session::get('coupon_id'),
				'coupon_code' 		=> Session::get('coupon_code')  ,
                'comment'             => $request['comment'],
                'discount'            => Session::get('discount'), 
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
        return view('orders.confirmOrder',$data);
    }

    public function payment(Request $request)
    {
        $input = $request->all();

        $api = new Api("rzp_test_tazXyaYClLVzyb", "QcFkC78PT0dkVGsPO8FWVMNB");

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($request['razorpay_payment_id'])) 
        {
            try 
            { 
                $response   = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>round($payment['amount'],2))); 
                $order     = $request->session()->get('order');
                $order['payment_id'] = $input['razorpay_payment_id'];
                $order['grand_total'] =  substr($payment['amount'] , 0, -2);
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
                        Session::forget('coupon_code');
                        Session::forget('coupon_id');
                        Session::forget('discount');
                        Session::forget('amount_with_discount');
                        Session::forget('amount_without_discount');
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
        $cart = Cart::where('user_id',Session::get('user_id'))->orderBy('cart_id','desc')->get();
        $totalcartamount = Cart::where('user_id',Session::get('user_id'))->sum('total_price');
        $data   = compact('title','totalcartamount','cart');
        return view('orders.mycart', $data);
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
            if($exist->quantity > $getRow->quantity){
                return Response()->json([
                    "success" => false,
                    "message" => 'No more products are allowded to add in cart',
                ]);
            }else{
                $qty = $exist->quantity + 1;
                $count_row = Cart::where(['user_id'=>$request['userid'],'product_id'=>$request['id']])->update(['quantity'=> $qty, 'total_price'=> $qty * round($getRow->selling_price,2)]); 
            }
        }else{
            $qty = 1;
            if($qty > $getRow->quantity){
                return Response()->json([
                    "success" => false,
                    "message" => 'No more products are allowded to add in cart',
                ]);
            }else{
                $count_row = Cart::create($data); 
            } 
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
            'module_type' 	    => $request['module_type'], 
            'created_at' 	    => date('Y-m-d H:i:s'),
            'updated_at' 	    => date('Y-m-d H:i:s'), 
        );
        $msg = "Product added to favourites successfully";
        
        $exist = Favourate::where(['user_id'=>$request['userid'],'product_id'=>$request['id'],'module_type'=>$request['module_type']])->first();
        if(!empty($exist)){
            $count_row = DB::table('favourate')->where(['user_id'=>$request['userid'],'product_id'=>$request['id'],'module_type'=>$request['module_type']])->delete(); 
            $msg = "Product removed from favourites successfully";
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
// || $exist->quantity == $getRow->quantity
        if($exist->quantity > $getRow->quantity ){
            return Response()->json([
                "success" => false,
                "message" => 'We have only '.$getRow->quantity.' products are available',
            ]);
        }else{ 
            $count_row = Cart::where(['user_id'=>$request['userid'],'product_id'=>$request['pid']])->update(['quantity'=> $qty, 'total_price'=> $qty * round($getRow->selling_price,2)]); 
        }
     

         
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
            return redirect()->back()->with('Success', 'Cart updated successfully');
        }else{
            return redirect()->back()->with('Failed', 'Something went wrong');
        } 
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

    public function myWishlist(Request $request)
    { 
        $title  = "My Wishlist";
        $favourate = Favourate::where('user_id',Session::get('user_id'))
        ->Where(function($query) use($request) {
            if($request['module'] == 'product'){
                $query->where('module_type',config('constant.WISHLIST.PRODUCTS'));
            }else{
                if(Session::get('role_id') != 2){
                    $query->where('module_type',config('constant.WISHLIST.EXPERT'));
                }else{
                    $query->where('module_type',config('constant.WISHLIST.PRODUCTS'));
                }
            } 
        })
        ->orderBy('favourate_id','desc')->paginate(15);
        $data   = compact('title','request','favourate');
        return view('orders.myWishlist', $data);
    }
 
    public function deleteWishlist(Request $request)
    {  
        $favourate = DB::table('favourate')->where('favourate_id',$request['favourate_id'])->delete();
        if(!empty($favourate)){
            return redirect()->back()->with('Success', 'Wishlist updated successfully');
        }else{
            return redirect()->back()->with('Failed', 'Wishlist not updated successfully');
        }
    }
 
    public function del_multi_wishlist(Request $request)
    {  
        $ids = explode(',',$request['areaofinterest']);
        if(count($ids)>0){
            foreach($ids as $id){
                $delete=DB::table('favourate')->where('favourate_id',$id)->delete(); 
            }
    		if($delete){ 
    			return Response()->json([
                    "success" => true,
                    "message" =>'Wishlist updated successfully',
                ]); 
    		}else{
    			return Response()->json([
                    "success" => false,
                    "message" => 'Wishlist not updated successfully',
                ]);
    		} 
        }else{
			return Response()->json([
                "success" => false,
                "message" => 'Wishlist not updated successfully',
            ]);
		}
    }


}
