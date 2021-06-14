@include('include.header')
@include('include.nav')
    <section id="banner" class="banner" role="banner" style="background-image:url({{asset('front_end/images/bannerimg1.png')}});">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bannerInner">
                        <img class="img-fluid" src="{{asset('front_end/images/bannerimg2.png')}}">
                        <h1 class="customHeading">DrolMaa Constellation Club</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</p>
                        <a href="#"class="donate">Donate</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutUs" class="aboutUs" role="aboutus">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="aboutText">
                        <img src="{{asset('front_end/images/aboutimg2.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="aboutPara">
                        <div class="seprate">
                            <p class="commonHeading">About</p>
                            <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                        </div>
                        <h2 class="allHeading1">A digital Platform that will help you maintain your mental health</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore
                        </p>
                        <a href="#" class="readMoreCta">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="ourServices" class="ourServices" role="Services">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="seprate">
                        <p class="commonHeading">Services</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="serviceBox">
                                <div class="serviceImage">
                                    <img src="{{asset('front_end/images/icon1.png')}}" class="img-fluid" alt="">
                                </div>
                                <p>Consulting Counselling</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="serviceBox">
                                <div class="serviceImage">
                                    <img src="{{asset('front_end/images/icon2.png')}}" class="img-fluid" alt="">
                                </div>
                                <p>Workshops Webinar</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="serviceBox">
                                <div class="serviceImage">
                                    <img src="{{asset('front_end/images/icon3.png')}}" class="img-fluid" alt="">
                                </div>
                                <p> Training</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="serviceBox">
                                <div class="serviceImage">
                                    <img src="{{asset('front_end/images/icon4.png')}}" class="img-fluid" alt="">
                                </div>
                                <p>Courses</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="serviceBox">
                                <div class="serviceImage">
                                    <img src="{{asset('front_end/images/icon5.png')}}" class="img-fluid" alt="">
                                </div>
                                <p>Internship</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="serviceBox">
                                <div class="serviceImage">
                                    <img src="{{asset('front_end/images/icon6.png')}}" class="img-fluid" alt="">
                                </div>
                                <p>Other activities</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="resources" class="resources" role="resources">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Resources</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>
                    <h2 class="allHeading1">A digital Platform that will help you<br> maintain your mental health
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br> incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="bookImage">
                        <img src="{{asset('front_end/images/bookimg1.png')}}" alt="" class="imgOne">   
                        <a href="#"><button class="sub">Subscribe Now</button></a>  
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="resourceText">
                        <img src="{{asset('front_end/images/resourceimg.png')}}" alt="">
                        <div class="resourcechannel">
                        <a href="#"><button class="sub">Subscribe Now</button></a>
                        </div>
                      

                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="mobileApp" class="mobileApp" role="mobileApp">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Mobile App</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mobileAppText">
                                <h2 class="allHeading1">Monitor your mental health and became happie
                                </h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore </p>
                                <a href="#" class="playcta"><img src="{{asset('front_end/images/iosimg.svg')}}" alt=""></a>
                                <a href="#" class="playcta"><img src="{{asset('front_end/images/gplayimg.svg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mobileAppImage">
                                <img src="{{asset('front_end/images/mobileImage.png')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section id="blog" class="blog" role="blog">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Our Blog</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>
                    <h2 class="allHeading1">Mind Blogging
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut<br>
                        labore et dolore magna aliqua. Lorem ipsum dolor sit amet,
                    </p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="blogImage">
                                <div class="blogBox" style="background-image:url({{asset('front_end/images/blogimg.jpg')}});">
                                </div>
                                <div class="blogText">
                                <p>February 5, 2021</p>
                                <h5>Mental Health</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="blogImage">
                                <div class="blogBox" style="background-image:url({{asset('front_end/images/blogimg.jpg')}});">
                                </div>
                                <div class="blogText">
                                <p>February 5, 2021</p>
                                <h5>Mental Health</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="blogImage">
                                <div class="blogBox" style="background-image:url({{asset('front_end/images/blogimg.jpg')}});">
                                </div>
                                <div class="blogText">
                                <p>February 5, 2021</p>
                                <h5>Mental Health</h5>
                                </div>
                            </div>
                        </div>
                        
                      
                    </div>
                    <div class="text-center">
                        <a href="#"><button class="sub">View All Categories</button></a>
                        </div>

                </div>
            </div>
        </div>
    </section>
    <section id="channel" class="channel" role="channel">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="channelbox">
                        <h4>G. Meyer Books & Spiritual
                            Traveler Press</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="channelbox">
                        <p>Sale Up To</p>
                        <h2><a href="#" class="offer">30% OFF</a></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="channelbox">
                    <a href="#"><button class="sub">Subscribe Now</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonial" class="testimonial" role="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="seprate">
                        <p class="commonHeading">Testimonials</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>
                    <h2 class="allHeading1">What Our Clients Say
                    </h2>
                    <div class="row">
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <div class="swiper-slide col-md-6">
                                    <div class="testimonialBox" style="background-image:url({{asset('front_end/images/quote.png')}})">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor
                                            incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet,
                                            consectetur
                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua.
                                        </p>
                                        <div class="testimonialImage" style="background-image:url({{asset('front_end/images/testimg.png')}})">
                                            <h5>Albert Willson</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide col-md-6">
                                    <div class="testimonialBox" style="background-image:url({{asset('front_end/images/quote.png')}})">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor
                                            incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet,
                                            consectetur
                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua.
                                        </p>
                                        <div class="testimonialImage" style="background-image:url({{asset('front_end/images/testimg.png')}})">
                                            <h5>Albert Willson</h5>
                                        </div>
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
    
    
  