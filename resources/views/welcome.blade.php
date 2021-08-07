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
                        <!-- start botton -->
                            <!-- Button trigger modal -->
                        <a  class="sub btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                        Talk to Our Expert
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Speak With Our Experts in Just One Click</h5>
                                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="name" placeholder="Name">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" name="email" placeholder="E-Mail">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="number" placeholder="Mobile Number">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="topic" placeholder="Topic">
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                        <button type="button" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end button -->
                        <!-- <a href="#"class="donate">Talk to Our Expert</a> -->
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
                        <a href="{{route('page.about_us')}}" class="readMoreCta">Know More <i class="fas fa-chevron-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(Session::has('user_id') && Session::has('role_id')){
        if(Session::get('role_id') != 3){?>
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
                                <?php if(count($services) >0 ){
                                    foreach($services as $service){?>
                                        <div class="col-sm-4">
                                            @if($service->services_title == 'Our Experts')
                                                <a href="{{route('our_experts')}}">
                                            @elseif($service->services_title == 'Our Training')
                                                <a href="{{route('our_training')}}">
                                            @elseif($service->services_title == 'Live Workshops')
                                            
                                                <a href="{{route('live_webinar')}}">
                                                 @elseif($service->services_title == 'Shops')
                                                <a href="{{route('page.shop')}}">
                                            @elseif($service->services_title == 'Other Activities')
                                                <a href="{{route('other_activities')}}">
                                            @endif
                                                <div class="serviceBox">
                                                    <div class="serviceImage">
                                                        <img src="{{asset('services/'.$service->services_photo)}}" class="img-fluid" alt="">
                                                    </div>
                                                    <p>{{$service->services_title}}</p>
                                                </div>
                                            </a>
                                        </div> 
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php }}else{ ?>
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
                            <?php if(count($services) >0 ){
                                foreach($services as $service){?>
                                    <div class="col-sm-4">
                                        @if($service->services_title == 'Our Experts')
                                            <a href="{{route('our_experts')}}">
                                        @elseif($service->services_title == 'Our Training')
                                            <a href="{{route('our_training')}}">
                                        @elseif($service->services_title == 'Live Workshops')
                                            <a href="{{route('live_webinar')}}">
                                        @elseif($service->services_title == 'Shops')
                                            <a href="{{route('page.shop')}}">
                                        @elseif($service->services_title == 'Other Activities')
                                            <a href="{{route('other_activities')}}">
                                        @endif
                                            <div class="serviceBox">
                                                <div class="serviceImage">
                                                    <img src="{{asset('services/'.$service->services_photo)}}" class="img-fluid" alt="">
                                                </div>
                                                <p>{{$service->services_title}}</p>
                                            </div>
                                        </a>
                                    </div> 
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }?>
    <!-- start featured products -->
    <section id="resources" class="resources" role="resources">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="seprate">
                        <p class="commonHeading">Categorys</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <?php if(count($category) >0 ){
                            foreach($category as $categorys){?> 
                                <div class="col-sm-4">
                                    <a href="{{route('page.shop',['category_id'=>$categorys->category_id])}}">
                                        <div class="serviceBox">
                                            <div class="serviceImage">
                                                <img src="{{asset('category/'.$categorys->category_image)}}" class="img-fluid" alt="">
                                            </div>
                                            <p>{{$categorys->category_name}}</p>
                                        </div>
                                    </a>
                                </div>  
                        <?php }} ?>
                    </div>
                </div>
                <div class="col-sm-12"> 
                    <a style="position: relative; margin-left: 90%;background-color: var(--yellow); height: 32px; padding: 5px 20px; border-radius: 3px; color: var(--white); font-size: 14px;" href="{{route('page.shop')}}" class="commonHeading">View All</a> 
                </div>
            </div>
        </div>
        
     <!--    <div class="container mcontainer">
	            <div class="owl-carousel testimonials-carousel">
	                
	                <div class="testimonial-item p-0 minhauto">
	                    <a href="#">
	                        <img src="http://localhost/BKP_27_07/drolamaa.i4dev.in/front_end/images/bannerimg1.png" class="w-100 h200 himagesize"
	                            alt="">
	                        <h3 class="text-left pl-3">bb}</h3>
	                    </a>
	                    <p class="text-justify px-3 mb-1  homecontentbox53char line-clamp">12345</p>
	                    <p class="text-left pl-3 m-0 mb-2">
	                        <span class="serv-rating">
	                            <div class="rate pl-3">
	                                <input type="radio"
	                                    {{ (!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng == 5) ? 'checked' : ''}}>
	                                <label for="star5"></label>
	                                <input type="radio"
	                                    {{ (!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 5 && $oGetRtng[0]->nAvrgRtng >= 4) ? 'checked' : ''}}>
	                                <label for="star4"></label>
	                                <input type="radio"
	                                    {{ (!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 4 && $oGetRtng[0]->nAvrgRtng >= 3) ? 'checked' : ''}}>
	                                <label for="star3"></label>
	                                <input type="radio"
	                                    {{ (!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 3 && $oGetRtng[0]->nAvrgRtng > 2) ? 'checked' : ''}}>
	                                <label for="star2"></label>
	                                <input type="radio"
	                                    {{ (!empty($oGetRtng) && $oGetRtng[0]->nAvrgRtng < 2 && $oGetRtng[0]->nAvrgRtng >= 1) ? 'checked' : ''}}>
	                                <label for="star1"></label>
	                        </span>
	                </div>
	                </span>
	                <span style="font-size: 13px; margin-top: 3px;">fbfbbf</span>
	                </p>
	                <div class="text-center py-2 pt-3 px-0">
	                    <a href="#"
	                        class="btn-primary btn mb-2">Know More</a>
	                </div>
	            </div>
	
	        </div>

	        </div>




                   <div class="mt-4"> 
                    <a href="{{route('page.shop')}}" class=""><button class="sub">See All</button></a>
                                    </div>--> 
                
    </section> 
    <!-- end featured products -->
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
                        <img src="{{asset('front_end/images/bookimg1.png')}}" alt="" class="img-fluid imgOne">   
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
                        <a href="{{route('page.blog')}}"><button class="sub">View All Categories</button></a>
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
                        <!-- Button trigger modal -->
                    <button type="button" class="sub btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Click to see Coupon Code</button>
<!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Get Coupan Code</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                <input type="email" class="form-control" placeholder="E-Mail" aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                <input type="number" class="form-control" placeholder="Mobile Number" aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
                                    </div>
                            </div>
                    </div>
                </div>
                  
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
    <section id="contact_form_home" class="testimonial"> 
        <div class="container">
        <div class="row">
        <div class="col-md-4 col-lg-5  pt-3 d-flex align-items-end justify-content-start">
            <img src="{{asset('front_end/images/contact_back.png')}}" alt="" sizes="" srcset="">
        </div>
                <div class="col-md-8 col-lg-7">
                    <div class="seprate">
                        <p class="commonHeading">Contact Us</p>
                        <span class="cimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    </div>
                    Let's talk!
        @include('include.validation_message')
        @include('include.auth_message')
        <form action="{{route('contact-submit')}}" method="post" class="form-contact home_contact">
    @csrf
        <input type="hidden" value="{{config('constant.ENQUIERY.CONTACT')}}" name="module_type">
        <input type="hidden" value="0" name="module_id">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" value="{{old('name')}}" placeholder="Name" name="name" aria-label="Name"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" value="{{old('phone')}}" name="phone" placeholder="Phone" aria-label="Phone"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" value="{{old('email')}}" name="email" placeholder="Email" aria-label="Email"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-sm-12">
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"
                    placeholder="Message">{{old('message')}}</textarea>
            </div>
            <button name="submit" class="submit-contact">Sumbit</button>
</form>
        </div>
        
        </div>
        
</div>
</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
        
    </script>
@include('include.footer')
@include('include.footer_bottom')
    
    
  