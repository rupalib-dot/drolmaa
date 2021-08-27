@include('include.header')
@include('include.nav')
<style>
.service_detail
{    
    max-width: 900px;
    max-height: 122px;
    overflow: hidden;
}
    
    </style>
<section id="contact-page-inner" id="contact-page-inner" role="contact" style="background-image:url({{asset('front_end/images/s-img.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Services</h2>
            </div>
        </div>
    </div>
</section>
<section id="service-care" class="service-care">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="care-text text-center">
                    <h3 class="glo-heading">Psychological Services</h3>
                    <span class="gimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    <p class="g-text text-center">Commodo tempus sapien sit bibendum sit morbi auctor molestie rutrum pellentesque
                        eget vitae<br> justo
                        congue amet malesuada
                    </p>
                </div>
                <div class="row">
                @if(count($services) >0 )
                    @foreach($services as $service)
                        @if($service->services_title == 'Our Experts')
                            <div class="col-md-4"> 
                                <a href="{{route('our_experts')}}">
                                    <div class="cycle-box" style="background-image:url({{asset('services/'.$service->services_photo)}})">  </div> 
                                    <h5 class="cyle-des text-center text-center">{{$service->services_title}}</h5>
                                    <p class="service_detail g-text text-center">{{$service->services_detail}}</p>   
                                </a> 
                            </div> 
                        @elseif($service->services_title == 'Our Training')
                            <div class="col-md-4"> 
                                <a href="{{route('our_training')}}">
                                    <div class="cycle-box" style="background-image:url({{asset('services/'.$service->services_photo)}})">  </div> 
                                    <h5 class="cyle-des text-center text-center">{{$service->services_title}}</h5>
                                    <p class="service_detail g-text text-center">{{$service->services_detail}}</p>    
                                </a> 
                            </div>  
                        @elseif($service->services_title == 'Live Workshops')
                            <div class="col-md-4"> 
                                <a href="{{route('live_webinar')}}">
                                    <div class="cycle-box" style="background-image:url({{asset('services/'.$service->services_photo)}})">  </div> 
                                    <h5 class="cyle-des text-center text-center">{{$service->services_title}}</h5>
                                    <p class="service_detail g-text text-center">{{$service->services_detail}}</p>   
                                </a> 
                            </div>  
                        @elseif($service->services_title == 'Shops')
                            <div class="col-md-4"> 
                                <a href="{{route('page.shop')}}">
                                    <div class="cycle-box" style="background-image:url({{asset('services/'.$service->services_photo)}})">  </div>
                                    <h5 class="cyle-des text-center text-center">{{$service->services_title}}</h5>
                                    <p class="service_detail g-text text-center">{{$service->services_detail}}</p>  
                                </a> 
                            </div>  
                        @elseif($service->services_title == 'Other Activities')
                            <div class="col-md-4"> 
                                <a href="{{route('other_activities')}}">
                                    <div class="cycle-box" style="background-image:url({{asset('services/'.$service->services_photo)}})">  </div>
                                    <h5 class="cyle-des text-center text-center">{{$service->services_title}}</h5>
                                    <p class="service_detail g-text text-center">{{$service->services_detail}}</p>   
                                </a> 
                            </div>  
                        @endif
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section id="about-query" class="about-query">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <div class="ask-ques">
                    <h3 class="glo-heading">Frequently Asked Questions</h3>
                    <span class="gimg"><img src="{{asset('front_end/images/cimg.png')}}" alt=""></span>
                    <p class="g-text text-left">Commodo tempus sapien sit bibendum sit morbi auctor molestie rutrum pellentesque
                        eget vitae justo
                        congue amet malesuada
                    </p>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="card my-3">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button id="faq_button" class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                                <i class="fas fa-plus float-right"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne"  class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="faq_answer card-body">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                                deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.
                            <i class="fas fa-plus float-right"></i>   
                            </button>
                        </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="faq_answer card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                            in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                            deserunt mollit anim id est laborum.
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.
                            <i class="fas fa-plus float-right"></i>
                            </button>
                        </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="faq_answer card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                            in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                            deserunt mollit anim id est laborum.
                        </div>
                        </div>
                    </div>
                    <div class="card my-3">
                        <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod test hello.
                            <i class="fas fa-plus float-right"></i>
                            </button>
                        </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="faq_answer card-body">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                            in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
                            deserunt mollit anim id est laborum.
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div class="ques-image">
                    <img src="{{asset('front_end/images/img-0.png')}}" alt="" class="img-fluid">
                </div>
            </div>

        </div>
    </div>
</section>
<script>
function myFunction() {
  var dots = document.getElementById("oldtext");
  var more = document.getElementById("moretext");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "block") {
    dots.style.display = "none";
    more.style.display = "block";
    btnText.innerHTML = "Read less";
    moreText.style.display = "none";
  } 
  if(more.style.display === "none") {
    dots.style.display = "block";
    more.style.display = "block";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";
  }
  else{
    dots.style.display = "block";
    more.style.display = "none";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";  
  }
 
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        $('.card-header').click(function() {
            $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
        });
</script>

@include('include.footer')
@include('include.footer_bottom') 