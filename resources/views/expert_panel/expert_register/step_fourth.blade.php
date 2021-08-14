@include('include.header')
@include('include.nav')
<style>
.fa-rupee-sign
{
    font-size: 18px;
}
</style>
<section id="clientMemberLogin" class="clientMemberLogin padding-top" role="Member log In">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-every">
                    @include('include.auth_message')
                    <div class="clientTextF">
                        <h4 class="wel-heading">Welcome to</h4>
                        <h3>DrolMaa Constellation Club</h3>
                        <p class="clientP">Expert Register</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading width">Personal Details</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading width">Professional Details</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading width">Documents</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading width-last">Payment & Submit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="plan-every" class="plan-every" role="plan">
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="210000"
                                    data-buttontext="Pay 2,100 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="3_basic" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="530000"
                                    data-buttontext="Pay 5,300 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="3_advance" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="150000"
                                    data-buttontext="Pay 1,500 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="3_subscription" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="190000"
                                    data-buttontext="Pay 1,900 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="6_basic" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="500000"
                                    data-buttontext="Pay 5,000 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="6_advance" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="130000"
                                    data-buttontext="Pay 1,300 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="6_subscription" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="110000"
                                    data-buttontext="Pay 1,100 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="12_basic" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="480000"
                                    data-buttontext="Pay 4,800 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="12_advance" id="month" name="month">
                            </form>
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
                            <form action="{{ route('expert.fourth.step.post') }}" method="POST">
                                @csrf
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="rzp_test_tazXyaYClLVzyb" data-amount="125000"
                                    data-buttontext="Pay 1,250 INR" data-name="i4consulting.org"
                                    data-description="Rozerpay"
                                    data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
                                    data-prefill.name="{{$expert->full_name}}"
                                    data-prefill.email="{{$expert->email_address}}" data-theme.color="#ff7529">
                                </script>
                                <input type="hidden" value="12_subscription" id="month" name="month">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4 back-next">
            <a href="{{route('expert.third.step')}}" class="back">Back</a>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.footer_bottom')
<script>
$('.razorpay-payment-button').addClass('choose btn');
</script>