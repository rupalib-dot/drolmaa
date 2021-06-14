@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/abouimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">About Us</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-inner" class="about-inner">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="about-con">
                    <img src="{{asset('front_end/images/abimg.png')}}" alt="">
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="care-text">
                    <h3 class="glo-heading">Welcome To Psychological care</h3>
                    <span class="gimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                </div>
                <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </p>
                <p class="g-text">
                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.
                </P>
                <button class="appoint-btn">Appointment</button>
                <a href="#"><button class="learn-btn">Learn More</button></a>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-5">
                <div class="care-text">
                    <h3 class="glo-heading">Mission & History</h3>
                    <span class="gimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                </div>
                <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-2">
                <div class="care-text">
                    <h3 class="glo-heading">Awards Certificates</h3>
                    <span class="gimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                </div>
                <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="certificate-box">
                            <img src="{{asset('front_end/images/g-1.png')}}" alt="" class="m-img">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="certificate-box">
                            <img src="{{asset('front_end/images/g-2.png')}}" alt="" class="m-img">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="certificate-box">
                            <img src="{{asset('front_end/images/g-3.png')}}" alt="" class="m-img">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 pt-5">
                        <div class="care-text">
                            <h3 class="glo-heading">How It Works</h3>
                            <span class="gimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                        </div>
                        <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="blogImage">
                                    <div class="blogBox" style="background-image:url({{asset('front_end/images/f-1.png')}});">
                                    </div>
                                    <div class="phase-text">
                                        <h5 class="bold">1st Phase</h5>
                                        <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blogImage">
                                    <div class="blogBox" style="background-image:url({{asset('front_end/images/f-2.png')}});">
                                    </div>
                                    <div class="phase-text">
                                        <h5 class="bold">2nd Phase</h5>
                                        <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="blogImage">
                                    <div class="blogBox" style="background-image:url({{asset('front_end/images/f-3.png')}});">
                                    </div>
                                    <div class="phase-text">
                                        <h5 class="bold">Final Phase</h5>
                                        <p class="g-text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
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
@include('include.footer_bottom') 