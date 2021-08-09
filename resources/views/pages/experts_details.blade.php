@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
<div class="container-fluid">
    <div class="row">
        <div class="header_expert">
           <div class="mt-3 mb-3 text-center">
               <h3>Expert Profile</h3>
           </div>
           <div class="container mb-4">
                <div class="input-group">
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Enter City*" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Designation" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Speciality" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2 col-md-3">
                    <button type="button" class="w-100 btn btn-outline-danger">Search</button>
                     </div>
                </div>
           </div>
        </div>
    </div>
   </div>
            <div class="mb-5 container">
               <div class="row">
               <div class="pt-4  col-lg-8">
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{asset('front_end/images/expert_profile.svg')}}" class="card-img" alt="...">
                                <!-- <div class="pl-0 col-lg-7 expert_button">
                                    <a href="/" target="_blank">View Profile</a>
                                    <a href="/" target="_blank">Book Appointment</a>
                                </div> -->
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. Urmil Bishnoi</h5>
                                    <p class="text-muted">Ph.D Psychology, M.Phil - Psychology</p>
                                    <p class="text-muted">7 Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                    </div>
                                    <div class="mt-3  about_expert">
                                        <p  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; " id="oldtext">
                                            Dr. Urmil Bishnoi is an expert Physical Therapist with over 11 years experience
                                        </p>
                                        <p style="display:none" id="moretext">
                                            Dr. Urmil Bishnoi is an expert Physical Therapist with over 11 years experience providing direct patient care to individuals with physical disabilities and functional
                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae earum
                                        </p>
                                        <button class="btn btn-info" onclick="myFunction()" id="myBtn">Read more</button>
                                    </div>
                                            <!-- <div class="mt-5 pl-0 expert_button">
                                            <a style="display:none;" href="/" target="_blank">View Profile</a>
                                            <a href="/" target="_blank">Book Appointment</a>
                                        </div> -->
                                                <!-- <p class="text-muted mb-0">Availability ( Today)</p>
                                                <div class="pl-3 row">
                                                <div class="pl-0 col-lg-5 expert_time_slot">
                                                    <p> 05:30 PM</p>
                                                    <p> 05:30 PM</p>
                                                    <p> 05:30 PM</p>
                                                    <p> 05:30 PM</p>
                                                </div>

                                                </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-4 col-lg-4">
                    <div class="expert_profile_slot">
                       
                    </div>
                </div>
               </div>
        <div class="mb-5 container">
                <nav>
                    <div class="nav bg-light nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Info</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Availability</a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Feedback</a>
                    </div>
                </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h4>Marathahalli, Bangalore</h4>
                </div>
                     <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>
        </div>
        <div class="faq_heading">
            <h3>Faq</h3>
        </div>
        <div class="accordion" id="accordionExample">
          <div class="card my-3">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button id="faq_button" class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
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
@include('include.script')
@include('include.modal')
