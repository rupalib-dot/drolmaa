@include('include.header')
@include('include.nav')
<style>
.fa-rupee-sign
{
    font-size: 18px;
}
.plan-des{
    min-height: 340px;
} 
.razorpay-payment-button{
    color: #fff;
    background-color: #952a16;
    border-color: #952a16;  
    font-weight: 400; 
    text-align: center;
    vertical-align: middle; 
    user-select: none; 
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem; 
} 
form{
    text-align: center;
    padding-bottom: 20px;
}
</style>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/abouimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Pricing</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-inner" class="about-inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="plan-list">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="plan-sec">
                                <li class="Plan-button active" id="Plan-button-1"
                                    onclick="openPlan('Plan-button-1','Plan-content-1')">3 Month Plan
                                </li>
                            </ul>
                            
                        </div>
                        <div class="col-md-4">
                            <ul class="plan-sec">
                                <li class="Plan-button" id="Plan-button-2"
                                    onclick="openPlan('Plan-button-2','Plan-content-2')">
                                    6
                                    Month Plan
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="plan-sec">
                                <li class="Plan-button" id="Plan-button-3"
                                    onclick="openPlan('Plan-button-3','Plan-content-3')">
                                    1
                                    year Plan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row Plan-content active" id="Plan-content-1">
                    <div class="col-md-4">
                        <div class="plan-des">

                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 2,100</h3>
                                <p>3 Months (Basic plan)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 2100 && $subscription_data->month == 3 && $subscription_data->plan_detail == 'basic')
                            @else
                                <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="210000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="3_basic" id="month" name="month">
                                </form> 
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 5,300</h3>
                                <p>3 Months (Advance Plan)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 5300 && $subscription_data->month == 3 && $subscription_data->plan_detail == 'advance')
                            @else
                                <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="530000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="3_advance" id="month" name="month">
                                </form> 
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 1,500</h3>
                                <p>3 Months (Subscription)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 1500 && $subscription_data->month == 3 && $subscription_data->plan_detail == 'subscription')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="150000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="3_subscription" id="month" name="month">
                                </form> 
                                @endif
                        </div>
                    </div>
                </div>
                <div class="row Plan-content" id="Plan-content-2">
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 1,900</h3>
                                <p>6 Months (Basic plan)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 1900 && $subscription_data->month == 6 && $subscription_data->plan_detail == 'basic')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="190000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="6_basic" id="month" name="month">
                                </form> 
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 5,000</h3>
                                <p>6 Months (Advance Plan)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 5000 && $subscription_data->month == 6 && $subscription_data->plan_detail == 'advance')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="500000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="6_advance" id="month" name="month">
                                </form> 
                            @endif
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 1,300</h3>
                                <p>6 Months (Subscription)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 1300 && $subscription_data->month == 6 && $subscription_data->plan_detail == 'subscription')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="130000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="6_subscription" id="month" name="month">
                                </form> 
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row Plan-content" id="Plan-content-3">
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 1,100</h3>
                                <p>1 Year (Basic plan)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 1100 && $subscription_data->month == 12 && $subscription_data->plan_detail == 'basic')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="110000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="12_basic" id="month" name="month">
                                </form> 
                                @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 4,800</h3>
                                <p>1 Year (Advance Plan)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount ==4800 && $subscription_data->month == 12 && $subscription_data->plan_detail == 'advance')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="480000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="12_advance" id="month" name="month">
                                </form> 
                                @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1_1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i>  1,250</h3>
                                <p>1 Year (Subscription)</p>
                            </div>
                            <div class="plan-body">
                                <ul>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                    <li>Self hosted store</li>
                                </ul>
                            </div>
                            @if(!empty($subscription_data) && $subscription_data->register_amount == 1250 && $subscription_data->month == 12 && $subscription_data->plan_detail == 'subscription')
                            @else
                            <form action="{{ route('expert.subscribe.post') }}" method="POST">
                                    @csrf
                                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_tazXyaYClLVzyb" data-amount="125000"
                                        data-buttontext="Upgrade" data-name="i4consulting.org"
                                        data-description="Rozerpay"
                                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                        data-prefill.name="{{$record_data->full_name}}"
                                        data-prefill.email="{{$record_data->email_address}}" data-theme.color="#ff7529">
                                    </script>
                                                    <input type="hidden" value="{{$record_data->user_id}}" id="user_id" name="user_id">
                                    <input type="hidden" value="12_subscription" id="month" name="month">
                                </form> 
                            @endif
                        </div>
                    </div>
                </div> 
            </div>
        </div>
</section>
 
@include('include.footer')
@include('include.footer_bottom') 