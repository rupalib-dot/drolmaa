@include('include.header')
@include('include.nav')
<style>
p{
   margin-bottom: 20px;
}
.razorpay-payment-button {
    position: relative;
    background-color: var(--yellow);
    color: var(--white);
    border-radius: 3px;
    margin-right: 13px;
    margin-left: 15px;
    padding: 10px;
} 
</style>

<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/shopimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Confirm Order</h2>
            </div>
        </div>
    </div>
</section>
<section id="checkout" class="checkout">
    <div class="container">
        @include('include.validation_message')
        @include('include.auth_message') 
        <h3 style="margin-bottom: 30px;">Order No:- {{$order['order_no']}}</h3>
        <div class="row" >  
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="row">   
                    <div class="col-lg-6">  
                        <p>Full Name:- {{$order['full_name']}}</p> 
                        <p>Address Line1:- {{$order['address1']}}</p>
                        <p>Address Line2:- @if(!empty($order['address2'])){{$order['address2']}} @else N/A @endif</p>   
                        <p>Mobile Number:- +91 {{$order['mobile_number']}}</p>
                        <p>Email Address:- {{$order['email_address']}}</p> 
                        <p>Total :- <i class="fas fa-rupee-sign"></i> {{number_format($order['orignal_grand_total'],2,'.',',')}}</p> 
                    </div>
                    <div class="col-lg-6"> 
                        <p>Grand Total:- <i class="fas fa-rupee-sign"></i> @if($order['grand_total'] != '' && $order['grand_total'] !=  0) {{number_format($order['grand_total'],2,'.',',')}} @else {{number_format($order['orignal_grand_total'],2,'.',',')}} @endif</p>  
                        @if($order['coupon_id'] != '')
                            <p>Coupon Code:- {{$order['coupon_code']}}</p> 
                            <p>Discount:- <i class="fas fa-rupee-sign"></i> {{$order['discount']}}</p>   
                        @endif
                        <p>Payment Mode:- {{array_search($order['payment_type'],config('constant.PAYMENT_MODE'))}}</p>
                        <p>Order Status:- {{array_search($order['order_status'],config('constant.STATUS'))}}</p> 
                    </div>  
                    <div class="col-lg-12">
                        <p>Comment:- {{$order['comment']}}</p> 
                    </div>
                    <form action="{{route('order.payment')}}" method="POST">
                        @csrf  
                        

                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="rzp_test_tazXyaYClLVzyb"
                                data-amount="@if($order['grand_total'] != '' && $order['grand_total'] !=  0){{round($order['grand_total'],2)}}00 @else {{round($order['orignal_grand_total'],2)}}00 @endif"
                                data-buttontext="Pay @if($order['grand_total'] != '' && $order['grand_total'] !=  0){{number_format($order['grand_total'],2,'.',',')}} INR @else{{number_format($order['orignal_grand_total'],2,'.',',')}} INR @endif"
                                data-name="i4consulting.org"
                                data-description="Rozerpay"
                                data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                data-prefill.name="{{Session::get('full_name')}}"
                                data-prefill.email="rupalibhargava@gmail.com"
                                data-theme.color="#ff7529">
                        </script>
                    </form> 
                </div>
            </div> 
        </div> 
    </div>
</section>
@include('include.footer')
@include('include.script') 



 