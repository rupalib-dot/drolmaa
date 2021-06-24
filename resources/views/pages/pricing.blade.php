@include('include.header')
@include('include.nav')
<style>
.fa-rupee-sign
{
    font-size: 18px;
}
.plan-des{
    min-height: 300px;
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
                                style="background-image:url({{asset('front_end/images/planimg1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 2,100</h3>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg2.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 5,300</h3>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg2.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 1,500</h3>
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
                        </div>
                    </div>
                </div>
                <div class="row Plan-content" id="Plan-content-2">
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1.png')}});">
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg2.png')}});">
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
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg2.png')}});">
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
                        </div>
                    </div>
                </div>
                <div class="row Plan-content" id="Plan-content-3">
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg1.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 1,100</h3>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg2.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i> 4,800</h3>
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
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="plan-des">
                            <div class="plan-box"
                                style="background-image:url({{asset('front_end/images/planimg2.png')}});">
                                <h3><i class="fas fa-rupee-sign"></i>  1,250</h3>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
 
@include('include.footer')
@include('include.footer_bottom') 