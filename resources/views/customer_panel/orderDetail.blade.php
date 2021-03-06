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
        <div class="row">    
            <div class="col-lg-6">  
                <p>Name :- {{$order['full_name']}}</p>
                <p>Company Name :- {{$order['company_name']}}</p>
                <p>Mobile Number :- {{$order['mobile_number']}}</p>
                <p>Email Address :- {{$order['email_address']}}</p> 
                <p>Gender :- {{array_search($order['user_gender'],config('constant.GENDER'))}}</p>  
                <p>Pincode :- {{$order['pincode']}}</p> 
                <p>Payment Id :- {{$order['payment_id']}}</p>
                <p>Payment Mode :- {{array_search($order['payment_type'],config('constant.PAYMENT_MODE'))}}</p>
                <p>Payment Status :- {{$order['payment_status']}}</p> 
            </div>
            <div class="col-lg-6">
                <p>Grand Total :- {{$order['grand_total']}}</p> 
                <p>Address Line1 :- {{$order['address1']}}</p>
                <p>Address Line2 :- {{$order['address2']}}</p> 
                <p>Country :- {{CommonFunction::GetSingleField('country','country_name','country_id',$order['country_id'])}}</p>
                <p>State :- {{CommonFunction::GetSingleField('state','state_name','state_id',$order['state_id'])}}</p>
                <p>City :- {{CommonFunction::GetSingleField('city','city_name','city_id',$order['city_id'])}}</p>  
                <p>Order Status :- {{array_search($order['order_status'],config('constant.STATUS'))}}</p>
                <p>Order Date :- {{date('M d, Y',strtotime($order['created_at']))}}</p>
            </div>  
        </div>
        <hr class="mt-0">
    </div>
</section>
<section id="your-cart" class="your-cart">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="cart-box">
                    <table class="table box-demo" style="margin-bottom:0px">
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
                                        <td class="py-0"> <p class="indrupee"> &#8377 <span class="yerupee">{{$getOrderData->price}}</span></p> </td>
                                        <td class="text-red py-0"> <p class="indrupee">&#8377 <span class="yerupee">{{$getOrderData->total_price}}</span></p></td>
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
 