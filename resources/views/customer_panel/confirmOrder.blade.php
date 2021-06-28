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
                        <p>Company Name:- @if(!empty($order['company_name'])){{$order['company_name']}} @else N/A @endif</p>
                        <p>Address Line1:- {{$order['address1']}}</p>
                        <p>Address Line2:- @if(!empty($order['address2'])){{$order['address2']}} @else N/A @endif</p>
                        <p>Country:- {{CommonFunction::GetSingleField('country','country_name','country_id',$order['country_id'])}}</p>
                        <p>State:- {{CommonFunction::GetSingleField('state','state_name','state_id',$order['state_id'])}}</p>
                        <p>City:- {{CommonFunction::GetSingleField('city','city_name','city_id',$order['city_id'])}}</p> 
                    </div>
                    <div class="col-lg-6">
                        <p>Pincode:- {{$order['pincode']}}</p> 
                        <p>Gender:- {{array_search($order['user_gender'],config('constant.GENDER'))}}</p> 
                        <p>Mobile Number:- +91 {{$order['mobile_number']}}</p>
                        <p>Email Address:- {{$order['email_address']}}</p>
                        <p>Grand Total:- <i class="fas fa-rupee-sign"></i> {{number_format($order['grand_total'],2,'.',',')}}</p> 
                        <p>Payment Mode:- {{array_search($order['payment_type'],config('constant.PAYMENT_MODE'))}}</p>
                        <p>Order Status:- {{array_search($order['order_status'],config('constant.STATUS'))}}</p>
                    </div> 
                    
                    <form action="{{route('order.payment')}}" method="POST">
                        @csrf  
                        <script  
                                data-key="{{ env('RAZORPAY_KEY') }}"
                                data-amount="{{round($order['grand_total'],2)}}00"
                                data-buttontext="Pay {{round($order['grand_total'],2)}} INR"
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



 