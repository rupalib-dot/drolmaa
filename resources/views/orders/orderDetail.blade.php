@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/shopimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Order NO:- {{$order['order_no']}}</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-product" class="about-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="text-align: right;margin-bottom: 30px;"></div> 
            <div class="col-lg-6" style="text-align: right;margin-bottom: 30px;"> <a href="{{route('customer.order')}}"><button class="update btn ">Back</button></a> </div>
        </div>
        <div class="m-1 row order-details_aftr" >    
            <div class="col-lg-6">  
                <p>Name :- {{$order['full_name']}}</p> 
                <p>Mobile Number :- +91 {{$order['mobile_number']}}</p>
                <p>Email Address :- {{$order['email_address']}}</p>  
                <p>Address Line1 :- {{$order['address1']}}</p>
                <p>Address Line2 :- {{$order['address2']}}</p>  
                <p>Payment Mode :- {{array_search($order['payment_type'],config('constant.PAYMENT_MODE'))}}</p>
                <p>Payment Status :- {{ucwords($order['payment_status'])}}</p> 
                <p>Order Status :- {{array_search($order['order_status'],config('constant.STATUS'))}}</p> 
            </div>
            <div class="col-lg-6"> 
                <p>Total :- <i class="fas fa-rupee-sign"></i> {{number_format($order['orignal_grand_total'],2,'.',',')}}</p> 
                <p>Grand Total:- <i class="fas fa-rupee-sign"></i> @if($order['grand_total'] != '' && $order['grand_total'] !=  0) {{number_format($order['grand_total'],2,'.',',')}} @else {{number_format($order['orignal_grand_total'],2,'.',',')}} @endif</p>  
                @if($order['coupon_id'] != '')
                    <p>Coupon Code:- {{$order['coupon_code']}}</p> 
                    <p>Discount:- <i class="fas fa-rupee-sign"></i> {{$order['discount']}}</p>   
                @endif  
                <p>Payment Id :- {{$order['payment_id']}}</p>
                <p>Order Date :- {{date('M d, Y',strtotime($order['created_at']))}}</p>
                <p>Refund Id :-@if($order['refund_id'] == '') N/A @else {{$order['refund_id']}} @endif </p>
                <p>Refund Amount :- @if($order['refund_amount'] == '') N/A @else<i class="fas fa-rupee-sign"></i> {{number_format($order['refund_amount'],2,'.',',')}}@endif </p> 
            </div>  
            <div class="col-lg-12">
                <p>Comment:-{{$order['comment']}}</p> 
            </div>
        </div>
    </div>
</section>
<section id="your-cart" class="your-cart">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="cart-box">
                    <table class="d-lg-table table-responsive table box-demo" style="margin-bottom:0px">
                        <thead class="text-black">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th> 
                                <th scope="col">Total Price</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orderDetail)>0)
                                @foreach($orderDetail as $getOrderData)
                                    <tr>
                                        <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$getOrderData->product_id); ?>
                                        <td><img style="    width: 100px; height: 100px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="img-pro"> <p class="fnt mt-2">{{$getOrderData->product_name}}</p> </td>
                                        <td class="py-0"> {{$getOrderData->quantity}} </td>
                                        <td class="py-0"> <p class="indrupee"> &#8377 <span class="yerupee">{{number_format($getOrderData->price,2,'.',',')}}</span></p> </td>
                                        <td class="text-red py-0"> <p class="indrupee">&#8377 <span class="yerupee">{{number_format($getOrderData->total_price,2,'.',',')}}</span></p></td>
                                    </tr>
                                @endforeach 
                            @else
                                <tr>
                                    <td colspan="5"> No Record Found</td> 
                                </tr>
                                
                            @endif
                        </tbody>
                    </table>  
                </div>
            </div> 
        </div>
    </div>
</section>
@include('include.footer') 
@include('include.footer_bottom') 
 