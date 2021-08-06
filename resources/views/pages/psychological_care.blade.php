@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/abouimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Psychological Care</h2>
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
                <a href="{{route('appointment.create')}}"><button class="appoint-btn">Appointment</button></a> 
            </div> 
        </div>
</section>
@include('include.footer')
@include('include.footer_bottom') 