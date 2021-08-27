@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12"> 
                <div class="profile-form">
                 @include('include.validation_message')
                    @include('include.auth_message')
                    <h3 class="order-content">{{$title}}</h3> 

                    <div class="row">   
                        <div class="col-lg-6">
                            <p>Name:- {{$appointment['name']}}</p>
                            <p>Date:- {{date('M d,Y',strtotime($appointment['date']))}}</p>
                            <p>Time:- {{$appointment['time']}}</p>
                            <p>Plan:- {{array_search($appointment['plan'],config('constant.PLAN'))}}</p>
                        </div>
                        <div class="col-lg-6">
                            <p>Payment Mode:- {{array_search($appointment['payment_mode'],config('constant.PAYMENT_MODE'))}}</p>
                            <p>Expert Name:- {{CommonFunction::GetSingleField('users','full_name','user_id',$appointment['expert'])}}</p>
                            <p>Designation:- {{CommonFunction::GetSingleField('designation','designation_title','designation_id',$appointment['designation'])}}</p>
                        </div> 
                        <form action="{{route('appointment.payment')}}" method="POST">
                            @csrf 
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb"
                                    data-amount="{{$appointment['amount']}}00"
                                    data-buttontext="Pay {{$appointment['payment_mode']}} INR"
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
    </div>
    </div>
    </div>
   
    </div>
</section>
@include('include.footer') 
@include('include.script') 
<script>
$('.razorpay-payment-button').addClass('choose btn');
</script>